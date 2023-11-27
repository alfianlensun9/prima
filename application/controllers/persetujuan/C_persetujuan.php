<?php 


class C_persetujuan extends CI_Controller{
    function __construct()
	{
        parent::__construct();
        $this->load->model('perencanaan/M_perencanaan', 'pr');
        $this->load->model('master/M_master', 'mst');
    }
    
    public function index(){
        $data['listperencanaan'] = $this->pr->getPerencanaanDiKonfirmasi();
        render('persetujuan/v_persetujuan', $data, 'persetujuan');
    }

    public function persetujuanDetail($id = 0){
        if($id == 0){
            redirect('perencanaan/C_persetujuan');
        }
        $data['header'] = $this->pr->getPerencanaanById($id);
        $data['detail'] = $this->pr->getPerencanaanDetail($id);
        render('persetujuan/v_persetujuan_detail', $data, 'persetujuan');
    }

    public function persetujuanDetailValidasi($iddetail){
        $data['header'] = $this->pr->getPerencanaanDetailById($iddetail);
        $data['indikator'] = $this->mst->getMstIndikator();
        render('persetujuan/v_persetujuan_detail_validasi', $data, 'persetujuan');
    }

    public function persetujuanDetailPending($iddetail){
        $data['header'] = $this->pr->getPerencanaanDetailById($iddetail);
        $data['alasanpending'] = $this->mst->getMstAlasanPending();
        render('persetujuan/v_persetujuan_detail_pending', $data, 'persetujuan');
    }

    public function confirmValid($id,$iddetail){
        $affected_rows = $this->pr->confirmValid($iddetail);
        redirect(base_url('/persetujuan/C_persetujuan/persetujuanDetail/'.$id));
    }

    public function confirmPending($id,$iddetail){
        $affected_rows = $this->pr->confirmPending($iddetail);
        // dd($affected_rows);
        redirect(base_url('/persetujuan/C_persetujuan/persetujuanDetail/'.$id));
    }
}