<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog_model extends CI_Model
{

    public function insertBlog($data)
    {
        $this->db->insert('blog', $data);
    }
    public function insertComment($data)
    {
        $this->db->insert('comment', $data);
    }
    public function insertGallery($data)
    {
        $this->db->insert('galleries', $data);
    }
    public function insertEvent($data)
    {
        $this->db->insert('events', $data);
    }
}
