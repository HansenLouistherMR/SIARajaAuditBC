<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_akun_auditor extends CI_Model
{

    private $_table = "list_akun";

    public function rulesData()
    {
        return [
            [
                'field' => 'no_akun',
                'label' => 'no_akun',
                'rules' => 'required', // Add any additional validation rules here
            ],
            [
                'field' => 'List',
                'label' => 'List',
                'rules' => 'link', // Add any additional validation rules here
            ],
        ];
    }

    public function getAll()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT 
        menu.id as id,
        menu.nama_menu as nama_menu,
        menu.kode_role as kode_role,
        menu.link as link,
        menu.kd_icon as kd_icon,
        roles.nama_role as nama_role,
        roles.Keterangan as Keterangan,
        icon_menu.nama_icon as nama_icon,
        icon_menu.icon_desc as icon_desc
         FROM menu menu 
        INNER JOIN role roles 
        ON roles.kode_role=menu.kode_role
        INNER JOIN icon_menu icon_menu
        ON menu.kd_icon=icon_menu.id";

        return $this->db->query($sql)->result();
    }



    public function GetDataAkun()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT 
			list_akun.no as id, list_akun.list as list, 
			daftar_akun.kode_akun,
			daftar_akun.nama_akun as nama_akun,
			list_akun.no_urut
			FROM
				daftar_akun daftar_akun
			LEFT JOIN
				list_akun
			ON list_akun.Kode_akun = daftar_akun.kode_akun
			ORDER BY daftar_akun.kode_akun ASC";

        return $this->db->query($sql)->result();
    }

    public function HetfILTERGetDataAkun()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT 
        daftar_akun.kode_akun as kode_akun,
		daftar_akun.nama_akun as nama_akun
         FROM list_akun list_akun 
        LEFT JOIN daftar_akun daftar_akun
        ON list_akun.Kode_akun = daftar_akun.kode_akun
		WHERE daftar_akun.kode_akun IS NOT NULL
        GROUP BY daftar_akun.nama_akun
		ORDER BY  daftar_akun.kode_akun ASC";

        return $this->db->query($sql)->result();
    }


    public function GetDataAkunEdit()
    {
        //return $this->db->get($this->_table)->result();
        $sql = "SELECT 
        kode_akun as kode_akun,
		nama_akun as nama_akun
         FROM daftar_akun
		 ORDER BY  kode_akun ASC";

        return $this->db->query($sql)->result();
    }

    public function getIcon()
    {
        // Mengambil data dari tabel role
        $sql = "SELECT * FROM icon_menu";
        return $this->db->query($sql)->result();
    }


    public function getdataNamaAKunfilter()
    {
        $post = $this->input->post();
        $nama_akun = $post["nama_akun"];

        $sql = "SELECT 
        daftar_akun.kode_akun,
		list_akun.no as id, 
		list_akun.list as list, 
		daftar_akun.nama_akun as nama_akun 
		FROM list_akun list_akun LEFT JOIN daftar_akun daftar_akun 
		ON list_akun.kode_akun = daftar_akun.kode_akun WHERE daftar_akun.kode_akun =  '$nama_akun'";
        return $this->db->query($sql)->result();

    }


    public function getByNomor($no)
    {

        // $this->db->select('*');
        // $this->db->from('menu');
        // $this->db->join('category', 'menu.category_id = category.id');
        // $this->db->where('menu.id', $no);
        // $query = $this->db->get();
        // return $query->row();


        $this->db->select('*');
        $this->db->from('list_akun');
        $this->db->where('no', $no);
        $query = $this->db->get();
        return $query->row();


    }

    public function update()
    {
        $post = $this->input->post();

        // Validate input data
        $data = [
            'list' => $post['list'],
            'no_akun' => $post['no_akun'],
        ];

        $this->db->where('no', $post['id']);
        $this->db->update('list_akun', $data);

    }

    public function save()
    {
        $post = $this->input->post();

        $data = array(
            'List' => $post["List"],
            'no_akun' => $post["no_akun"],
        );

        $this->db->insert('list_akun', $data);

    }


    public function delete($no)
    {
        return $this->db->delete($this->_table, array("no" => $no));
    }


}