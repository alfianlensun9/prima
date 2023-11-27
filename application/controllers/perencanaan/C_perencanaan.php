<?php 


class C_perencanaan extends CI_Controller{
    function __construct()
	{
        parent::__construct();
        $this->load->model('perencanaan/M_perencanaan', 'pr');
        $this->load->model('master/M_master', 'mst');
    }
    
    public function index(){
        $data['tahun'] = range(date('Y')-1, date('Y')+1);
        $data['listperencanaan'] = $this->pr->getPerencanaan();
        render('perencanaan/v_perencanaan', $data, 'perencanaan');
    }

    public function perencanaanDetail($id = 0){
        if($id == 0){
            redirect('perencanaan/C_perencanaan');
        }
        $data['header'] = $this->pr->getPerencanaanById($id);
        $data['detail'] = $this->pr->getPerencanaanDetail($id);
        $data['kategori'] = $this->mst->getMasterKategoriAlkes();
        render('perencanaan/v_perencanaan_detail', $data, 'perencanaan');
    }

    public function panduan(){
        $data['panduan'] = $this->pr->getPanduan();
        render('panduan/v_panduan', $data, 'panduan');
    }
    

    public function createPerencanaan(){
        $check = $this->pr->checkPerencanaan($this->input->post('tahun'));

        if ($check !== null){
            $this->session->set_flashdata('errcreate', 'Data sudah ada');
        } else {
            $id = $this->pr->createPerencanaan();    
            redirect('perencanaan/C_perencanaan/perencanaanDetail/'.$id);
        }
    }

    public function deletePerencanaan($tahun = 0){
        $id = $this->pr->deletePerencanaan($tahun);        
        redirect('perencanaan/C_perencanaan');
    }

    public function createPerencanaanDetail($id = 0){
        // $check = $this->pr->checkPerencanaanDetail();
        $id = $this->pr->createPerencanaanDetail($id);

        echo json_encode([
            'insert_id' => $id
        ]);
        // redirect('perencanaan/C_perencanaan/perencanaanDetail/'.$id);
    }

    public function uploadDataPendukung(){
        $config['upload_path'] = './assets/uploaddata/datapendukung';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|docx|xlsx';
        $config['max_size']  = '500000';
        $config['file_name'] = time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file')){
            $status = "error";
            $msg = '';
        }
        else{
            $dataupload = $this->upload->data();

            $status = "success";
            $msg = $dataupload['file_name']." berhasil diupload";
        }

        echo json_encode([
            'status' => $status == 'success',
            'dataupload' => $status == 'success' ? $dataupload : $msg
        ]);
    }

    public function uploadPanduan(){
        $config['upload_path'] = './assets/uploaddata/panduan';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|pdf';
        $config['max_size']  = '500000';
        $config['file_name'] = time();

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file')){
            $status = "error";
            $msg = 'Data yang di upload hanya boleh gambar atau pdf';
        }
        else{
            $dataupload = $this->upload->data();
            $this->pr->createPanduan($dataupload);
            $status = "success";
            $msg = $dataupload['file_name']." berhasil diupload";
        }

        redirect('perencanaan/C_perencanaan/panduan');        
    }


    public function deletePerencanaanDetail($id = 0){
        $id = $this->pr->deletePerencanaanDetail($id);        
        redirect('perencanaan/C_perencanaan/perencanaanDetail/'.$id);
    }

    public function konfirmasiPerencanaan($id){
        $affected = $this->pr->konfirmasiPerencanaan($id);
        echo json_encode([
            'affected_rows' => $affected
        ]);
    }

    public function getJsonDetailPerencanaanById($id){
        echo json_encode($this->pr->getPerencanaanDetailById($id));
    }

    public function laporan(){
        $data['listperencanaan'] = $this->pr->getPerencanaan();
        render('laporan/v_laporan', $data, 'laporan');
    }

    public function laporanDetail($id){
        if($id == 0){
            redirect('perencanaan/C_perencanaan/laporan');
        }
        $data['header'] = $this->pr->getPerencanaanById($id);
        $data['detail'] = $this->pr->getPerencanaanDetail($id);
        render('laporan/v_laporan_detail', $data, 'laporan');
    }

    public function laporanDetailQr($id){
        if($id == 0){
            redirect('perencanaan/C_perencanaan/laporan');
        }
        $data['header'] = $this->pr->getPerencanaanById($id);
        $data['detail'] = $this->pr->getPerencanaanDetail($id);
        render('laporan/v_laporan_detail_qr', $data, 'laporan');
    }

    public function dashboard(){
        render('dashboard/v_dashboard', [], 'dashboard');
    }
}