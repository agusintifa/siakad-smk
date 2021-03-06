<?php 

class Siswa extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->data['user_id']  = $this->session->userdata('user_id');
        if (!isset($this->data['user_id']))
        {
            $this->session->sess_destroy();
            $this->flashmsg('Anda harus login untuk mengakses halaman tersebut', 'danger');
            redirect('login');
        }

        $this->data['role_id'] = $this->session->userdata('role_id');
        if (!isset($this->data['role_id']) or $this->data['role_id'] != 1)
        {
            $this->session->sess_destroy();
            $this->flashmsg('Anda harus login sebagai siswa untuk mengakses halaman tersebut', 'danger');
            redirect('login');
        }

		$this->module = 'siswa';
	}

    public function index()
    {
        $this->data['title']    = 'Dashboard';
        $this->data['content']  = 'dashboard';
        $this->template($this->data, $this->module);
    }

	public function nilai()
    {
        $this->data['title']    = 'Dashboard';
        $this->data['content']  = 'nilai';
        $this->template($this->data, $this->module);
    }

    public function jadwal()
    {
        $this->data['title']    = 'Dashboard';
        $this->data['content']  = 'jadwal';
        $this->template($this->data, $this->module);
    }

    public function kelas()
    {
        $this->data['title']    = 'Dashboard';
        $this->data['content']  = 'kelas';
        $this->template($this->data, $this->module);
    }

    public function data_diri()
    {
        $this->load->model('Users');
        $this->data['user']     = Users::with('student')->find($this->data['user_id']);
        $this->data['siswa']    = $this->data['user']->student;
        $this->check_allowance(!$this->data['siswa'], ['Data siswa tidak ditemukan', 'danger']);

        $this->data['title']    = 'Data Diri';
        $this->data['content']  = 'detail_siswa';
        $this->template($this->data, $this->module);
    }

    public function edit_data_diri()
    {
        $this->data['title']    = 'Dashboard';
        $this->data['content']  = 'edit_siswa';
        $this->template($this->data, $this->module);
    }

    public function visi_misi()
    {
        $this->load->model('Headmasters');
        $this->data['headmaster']   = Headmasters::orderBy('start_period', 'DESC')
                                        ->get()
                                        ->first();
        $this->data['title']        = 'Visi Misi';
        $this->data['content']      = 'visimisi';
        $this->template($this->data, $this->module);
    }

    public function tahun_ajaran()
    {
        $this->load->model('School_years');
        $this->data['years']    = School_years::orderBy('year_id', 'DESC')->get();
        $this->data['title']    = 'Tahun Ajaran';
        $this->data['content']  = 'tahun_ajaran';
        $this->template($this->data, $this->module);
    }

}