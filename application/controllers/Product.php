<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Upload_model');
        if (!$this->session->userdata('user_id')) {
            redirect('user/login_view');
        }
    }
    public function index()
    {
        $data['products'] = $this->Upload_model->get_all();
        $this->load->view('upload/upload_list', $data);
    }

    public function add()
    {
        $this->load->view('upload/upload_create');
    }
    
    public function create()
    {
        $data = array(
            'name' => $this->input->post('name'),
            'slug' => $this->input->post('slug'),
            'category' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'discount' => $this->input->post('discount'),
            'final_price' => $this->input->post('final_price')
        );
        
        if (!empty($_FILES['image']['name'])) {
            $image = $this->_do_upload();
            $data['image'] = $image;
        }
        
        $this->Upload_model->insert($data);
        redirect('Product');
    }

    public function edit($id)
    {
        $data['upload'] = $this->Upload_model->get_by_id($id);

        $this->load->view('upload/upload_update', $data);
    }

    public function update()
    {
    
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $slug = $this->input->post('slug');
        $category = $this->input->post('category');
        $price = $this->input->post('price');
        $discount = $this->input->post('discount');
        $final_price = $this->input->post('final_price');

        $data = array(
            'name' => $name,
            'slug' => $slug,
            'category' => $category,
            'price' => $price,
            'discount' => $discount,
            'final_price' => $final_price,
        );
        // echo "<pre>";print_r($data);die("hi");

        if (!empty($_FILES['image']['name'])) {
            $image = $this->_do_upload();

            $upload = $this->Upload_model->get_by_id($id);
            if (file_exists('assets/upload/images/'.$upload->image) && $upload->image) {
                unlink('assets/upload/images/'.$upload->image);
            }

            $data['image'] = $image;
        }

        $this->Upload_model->update($data, $id);
        redirect('Product');
    }

    private function _do_upload()
    {
        $image_name = time().'-'.$_FILES["image"]['name'];

        $config['upload_path']      = 'assets/upload/images/';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 1000;
        $config['max_widht']        = 1000;
        $config['max_height']       = 1000;
        $config['file_name']        = $image_name;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('msg', $this->upload->display_errors('', ''));
            redirect('');
        }
        return $this->upload->data('file_name');
    }

    public function detail($id)
    {
        $data['upload'] = $this->Upload_model->get_by_id($id);
        $this->load->view('upload/upload_detail', $data);
    }
        
    public function add_to_cart($id)
    {
        $data = $this->Upload_model->get_cart_id($id);
        
        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }



}
