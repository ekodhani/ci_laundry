<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laundry extends CI_Model {

    public function getCucianMasuk()
    {
        $query = "SELECT laundry.id_laundry, laundry.nama_konsumen, laundry.berat, laundry.status, laundry.bayar, laundry.tgl_masuk, paket.nama_paket FROM `laundry` INNER JOIN paket on laundry.paket_id_paket = paket.id_paket WHERE `status` = 'masuk'";
        return $this->db->query($query);
    }

    public function getCucianKeluar()
    {
        $query = "SELECT laundry.id_laundry, laundry.nama_konsumen, laundry.berat, laundry.status, laundry.bayar, laundry.tgl_masuk, laundry.tgl_keluar, paket.nama_paket FROM `laundry` INNER JOIN paket on laundry.paket_id_paket = paket.id_paket WHERE `status` = 'keluar'";
        return $this->db->query($query);
    }

    public function getWhere($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    public function insert($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
}
