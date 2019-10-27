<?php

class Peoples extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Peoples_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $data['judul'] = 'List of Peoples';

        $this->load->model('Peoples_model', 'peoples');

        //load library
        $this->load->library('pagination');

        //ambil data keyword
        if($this->input->post('submit')){
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);

        }else{
            $data['keyword'] = $this->session->userdata('keyword');
        }
    

    //config
    $this->db->like('name', $data['keyword']);
    $this->db->or_like('email', $data['keyword']);
    $this->db->from('peoples');
    $config['total_rows'] = $this->db->count_all_results();
    $data['total_rows'] = $config['total_rows'];
    $config['per_page'] = 8;

    //initialize
    $this->pagination->initialize($config);

    $data['start'] = $this->uri->segment(3);
    $data['peoples'] = $this->peoples->getPeoples($config['per_page'], $data['start'], $data['keyword']);

    $this->load->view('templates/header', $data);
    $this->load->view('peoples/index', $data);
    $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['judul'] = 'Form Tambah Data Peoples';
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('peoples/tambah');
            $this->load->view('templates/footer');
        } else {
            $this->Peoples_model->tambahDataPeoples();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('peoples');
        }
    }

    public function detail($id)
    {
        $data['judul'] = 'Detail Data Peoples';
        $data['peoples'] = $this->Peoples_model->getPeoplesById($id);
        $this->load->view('templates/header', $data);
        $this->load->view('peoples/detail', $data);
        $this->load->view('templates/footer');
    }

    public function ubah($id)
    {
        $data['judul'] = 'Form Ubah Data Peoples';
        $data['peoples'] = $this->Peoples_model->getPeoplesById($id);
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('address', 'Alamat', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('peoples/ubah', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Peoples_model->ubahDataPeoples();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('peoples');
        }
    }

    public function hapus($id)
    {
        $this->Peoples_model->hapusDataPeoples($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('peoples');
    }
}