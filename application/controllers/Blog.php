<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Blog_model', 'model');
        $this->load->library('pagination');

        if ($this->session->userdata('email')) {
            redirect('admin/manageposts');
        }
    }

    public function index()
    {
        // Load library pagination
        $this->load->library('pagination');

        // Pagination configuration
        $config['base_url'] = base_url('blog/index');
        $config['total_rows'] = $this->db->count_all('blog');
        $config['per_page'] = 6; // Number of items per page
        $config['uri_segment'] = 3; // The segment in URL that contains the page number

        // Optional: Adjust this value based on your needs to ensure enough page links are shown
        $config['num_links'] = 5; // Number of page links to show before and after the current page

        // Pagination styling configuration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        // Initialize pagination
        $this->pagination->initialize($config);

        // Determine the page number
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Fetch data with pagination
        $this->db->order_by('date_post', 'DESC');
        $data['blog'] = $this->db->get('blog', $config['per_page'], $page)->result_array();
        $data['blog2'] = $this->db->get('blog')->result_array();

        // Load the views
        $this->load->view('templates/blog/header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('templates/blog/footer');
    }

    public function content($slug)
    {
        $data['blog'] = $this->db->get_where('blog', ['slug' => $slug])->row_array();
        $data['blog2'] = $this->db->get('blog')->result_array();

        // Mengambil komentar yang terkait dengan blog
        $this->db->select('comment.*');
        $this->db->from('comment');
        $this->db->join('blog', 'comment.comment_id = blog.id');
        $this->db->where('blog.id', $data['blog']['id']); // Menggunakan id blog yang sesuai
        $query = $this->db->get();
        $data['comments'] = $query->result_array(); // Simpan hasil query ke dalam array untuk ditampilkan

        $this->form_validation->set_rules('comment', 'Comment', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/blog/header_2', $data);
            $this->load->view('blog/content', $data);
            $this->load->view('templates/blog/footer');
        } else {
            $commentData = [
                'comment_id' => $data['blog']['id'],
                'comment' => htmlspecialchars($this->input->post('comment'), true),
                'date_created' => time()
            ];

            $this->model->insertComment($commentData);

            redirect('blog/content/' . $slug);
        }
    }

    public function galleries()
    {
        $data['galleries'] = $this->db->get('galleries')->result_array();
        $data['blog2'] = $this->db->get('blog')->result_array();


        $config['base_url'] = base_url('blog/galleries');
        $config['total_rows'] = $this->db->count_all('galleries');
        $config['per_page'] = 9; // Jumlah item per halaman
        $config['uri_segment'] = 3; // Segment URI tempat nomor halaman ditempatkan

        // Konfigurasi styling pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        // Inisialisasi pagination
        $this->pagination->initialize($config);

        // Ambil data dari database sesuai dengan pagination
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['galleries'] = $this->db->get('galleries', $config['per_page'], $page)->result_array();
        $data['blog2'] = $this->db->get('blog')->result_array();

        $this->load->view('blog/galleries', $data);
        $this->load->view('templates/blog/footer');
    }

    public function events()
    {
        // Load library pagination
        $this->load->library('pagination');

        // Pagination configuration
        $config['base_url'] = base_url('blog/events');
        $config['total_rows'] = $this->db->count_all('events');
        $config['per_page'] = 9; // Number of items per page
        $config['uri_segment'] = 3; // The segment in URL that contains the page number

        // Optional: Adjust this value based on your needs to ensure enough page links are shown
        $config['num_links'] = 5; // Number of page links to show before and after the current page

        // Pagination styling configuration
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        // Initialize pagination
        $this->pagination->initialize($config);

        // Determine the page number
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Fetch data with pagination
        $this->db->order_by('id', 'DESC'); // Assuming 'date' is the column for ordering
        $data['events'] = $this->db->get('events', $config['per_page'], $page)->result_array();
        $data['blog2'] = $this->db->get('blog')->result_array();

        $this->load->view('blog/events', $data);
        $this->load->view('templates/blog/footer');
    }
}
