<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Blog_model', 'model');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav');
        $this->load->view('templates/sidenav');
        $this->load->view('admin/index');
        $this->load->view('templates/footer');
    }

    public function managePosts()
    {
        $data['title'] = 'Admin - Manage Posts';
        $data['blog'] = $this->db->get('blog')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav');
        $this->load->view('templates/sidenav');
        $this->load->view('admin/manage_posts', $data);
        $this->load->view('templates/footer');
    }

    public function addNewPost()
    {
        $this->form_validation->set_rules('blog_title', 'Blog Title', 'required|trim');
        $this->form_validation->set_rules('preview', 'Preview', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');

        // Tambahkan aturan validasi khusus untuk file upload
        $this->form_validation->set_rules('image', 'Image', 'callback_image_upload');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Admin - Add New Post';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topnav');
            $this->load->view('templates/sidenav');
            $this->load->view('admin/add_new_post');
            $this->load->view('templates/footer');
        } else {
            // Load the slug helper
            $this->load->helper('slug');

            $blog_title = $this->input->post('blog_title', true);
            $slug = generate_slug($blog_title);

            $data = [
                'blog_title' => htmlspecialchars($blog_title),
                'slug' => $slug,
                'preview' => htmlspecialchars($this->input->post('preview', true)),
                'content' => htmlspecialchars($this->input->post('content', true)),
                'writter' => 'admin',
                'date_post' => time(),
                'date_edit' => time()
            ];

            // File upload sudah diverifikasi, lakukan proses upload
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '10000';
            $config['upload_path'] = './assets/images/post';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $data['image'] = $new_image;
            } else {
                // Jika upload gagal, tampilkan pesan kesalahan
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/addNewPost'); // Redirect kembali ke halaman tambah posting
            }

            // Panggil model untuk menyimpan data blog
            $this->model->insertBlog($data);

            // Set flashdata untuk pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
            redirect('admin/manageposts');
        }
    }

    // Fungsi callback untuk memeriksa upload file
    public function image_upload()
    {
        if (empty($_FILES['image']['name'])) {
            $this->form_validation->set_message('image_upload', 'The {field} field is required.');
            return false;
        } else {
            return true;
        }
    }


    public function edit($id)
    {
        $data['blog'] = $this->db->get_where('blog', ['id' => $id])->row_array();

        $data['title'] = 'Admin - Edit Post';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav');
        $this->load->view('templates/sidenav');
        $this->load->view('admin/edit_post', $data);
        $this->load->view('templates/footer');
    }

    public function editpost()
    {
        $id = $this->input->post('id');
        $data['blog'] = $this->db->get_where('blog', ['id' => $id])->row_array();

        $this->form_validation->set_rules('blog_title', 'Blog Title', 'required|trim');
        $this->form_validation->set_rules('preview', 'Preview', 'required|trim');
        $this->form_validation->set_rules('content', 'Content', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->edit($id);
        } else {
            $blog_title = htmlspecialchars($this->input->post('blog_title', true));
            $preview = htmlspecialchars($this->input->post('preview', true));
            $content = htmlspecialchars($this->input->post('content', true));
            $date_edit = time();

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/post';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['blog']['image'];
                    if ($old_image) {
                        unlink(FCPATH . 'assets/images/post/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('blog_title', $blog_title);
            $this->db->set('preview', $preview);
            $this->db->set('content', $content);
            $this->db->set('date_edit', $date_edit);
            $this->db->where('id', $id);
            $this->db->update('blog');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
            redirect('admin/edit/' . $id);
        }
    }

    public function delete($id)
    {
        // Hapus entri dari tabel 'blog'
        $this->db->delete('blog', ['id' => $id]);

        // Hapus entri terkait dari tabel 'comment'
        $this->db->delete('comment', ['comment_id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('admin/manageposts');
    }

    public function manageGalleries()
    {
        $data['title'] = 'Admin - Manage Galleries';
        $data['galleries'] = $this->db->get('galleries')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav');
        $this->load->view('templates/sidenav');
        $this->load->view('admin/manage_galleries', $data);
        $this->load->view('templates/footer');
    }

    public function addNewGallery()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        // Tambahkan aturan validasi khusus untuk file upload
        $this->form_validation->set_rules('image', 'Image', 'callback_image_upload');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Admin - Add New Gallery';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topnav');
            $this->load->view('templates/sidenav');
            $this->load->view('admin/add_new_gallery');
            $this->load->view('templates/footer');
        } else {

            $title = $this->input->post('title', true);
            $description = $this->input->post('description', true);

            $data = [
                'title' => htmlspecialchars($title),
                'description' => htmlspecialchars($description),
                'date_post' => time(),
            ];

            // File upload sudah diverifikasi, lakukan proses upload
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '10000';
            $config['upload_path'] = './assets/images/galleries';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $data['image'] = $new_image;
            } else {
                // Jika upload gagal, tampilkan pesan kesalahan
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/addNewGallery'); // Redirect kembali ke halaman tambah gallery
            }

            // Panggil model untuk menyimpan data gallery
            $this->model->insertGallery($data);

            // Set flashdata untuk pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
            redirect('admin/managegalleries');
        }
    }

    public function editGallery($id)
    {
        $data['gallery'] = $this->db->get_where('galleries', ['id' => $id])->row_array();

        $data['title'] = 'Admin - Edit Gallery';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav');
        $this->load->view('templates/sidenav');
        $this->load->view('admin/edit_gallery', $data);
        $this->load->view('templates/footer');
    }

    public function editsGallery()
    {
        $id = $this->input->post('id');
        $data['gallery'] = $this->db->get_where('galleries', ['id' => $id])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->editGallery($id);
        } else {
            $title = htmlspecialchars($this->input->post('title', true));
            $description = htmlspecialchars($this->input->post('description', true));

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/galleries';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['gallery']['image'];
                    if ($old_image) {
                        unlink(FCPATH . 'assets/images/galleries/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('title', $title);
            $this->db->set('description', $description);
            $this->db->where('id', $id);
            $this->db->update('galleries');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
            redirect('admin/editgallery/' . $id);
        }
    }

    public function deleteGallery($id)
    {
        // Hapus entri dari tabel 'blog'
        $this->db->delete('galleries', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('admin/managegalleries');
    }

    public function manageEvents()
    {
        $data['title'] = 'Admin - Manage Events';
        $data['events'] = $this->db->get('events')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav');
        $this->load->view('templates/sidenav');
        $this->load->view('admin/manage_events', $data);
        $this->load->view('templates/footer');
    }

    public function addNewEvent()
    {
        $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim');
        $this->form_validation->set_rules('period', 'Period', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        // Tambahkan aturan validasi khusus untuk file upload
        $this->form_validation->set_rules('image', 'Image', 'callback_image_upload');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Admin - Add New Event';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topnav');
            $this->load->view('templates/sidenav');
            $this->load->view('admin/add_new_event');
            $this->load->view('templates/footer');
        } else {

            $event_name = $this->input->post('event_name', true);
            $period = $this->input->post('period', true);
            $description = $this->input->post('description', true);

            $data = [
                'event_name' => htmlspecialchars($event_name),
                'period' => htmlspecialchars($period),
                'description' => htmlspecialchars($description),
                'date_post' => time(),
            ];

            // File upload sudah diverifikasi, lakukan proses upload
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '10000';
            $config['upload_path'] = './assets/images/events';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $data['image'] = $new_image;
            } else {
                // Jika upload gagal, tampilkan pesan kesalahan
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/addNewEvent'); // Redirect kembali ke halaman tambah gallery
            }

            // Panggil model untuk menyimpan data gallery
            $this->model->insertEvent($data);

            // Set flashdata untuk pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
            redirect('admin/manageevents');
        }
    }

    public function editEvent($id)
    {
        $data['event'] = $this->db->get_where('events', ['id' => $id])->row_array();

        $data['title'] = 'Admin - Edit Event';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topnav');
        $this->load->view('templates/sidenav');
        $this->load->view('admin/edit_event', $data);
        $this->load->view('templates/footer');
    }

    public function editsEvent()
    {
        $id = $this->input->post('id');
        $data['event'] = $this->db->get_where('events', ['id' => $id])->row_array();

        $this->form_validation->set_rules('event_name', 'Event Name', 'required|trim');
        $this->form_validation->set_rules('period', 'Period', 'required|trim');
        $this->form_validation->set_rules('description', 'Description', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->editEvent($id);
        } else {
            $event_name = htmlspecialchars($this->input->post('event_name', true));
            $period = htmlspecialchars($this->input->post('period', true));
            $description = htmlspecialchars($this->input->post('description', true));

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/images/events';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['event']['image'];
                    if ($old_image) {
                        unlink(FCPATH . 'assets/images/events/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('event_name', $event_name);
            $this->db->set('period', $period);
            $this->db->set('description', $description);
            $this->db->where('id', $id);
            $this->db->update('events');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
            redirect('admin/editevent/' . $id);
        }
    }

    public function deleteEvent($id)
    {
        // Hapus entri dari tabel 'blog'
        $this->db->delete('events', ['id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('admin/manageevents');
    }
}
