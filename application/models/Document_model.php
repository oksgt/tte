<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document_model extends CI_Model
{

    var $table = 'documents';
    var $view = 'v_documents';
    var $column_order = array('id', 'id_user', 'original_file_name', 'original_file_ext', 'upload_time', 'signed_file_name', 'signed_file_ext', 'signed_at', 'is_del');
    var $column_search = array('id', 'id_user', 'original_file_name', 'original_file_ext', 'upload_time', 'signed_file_name', 'signed_file_ext', 'signed_at', 'is_del');
    var $order = array('upload_time', 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    public function query($sql)
    {
        return $this->db->query($sql);
    }

    private function _get_datatables_query()
    {

        $where = array('is_del' => 0);
        $this->db->where($where);
        $this->db->from($this->view);
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $where = array('is_del' => 0);
        $this->db->where($where);
        $this->db->from($this->view);
        return $this->db->count_all_results();
    }

    public function get_data()
    {
        $where = array('is_del' => 0);
        $this->db->where($where);
        return $this->db->get($this->view);
    }

    public function save($object)
    {
        $this->db->insert($this->table, $object);
        return $this->db->insert_id();
    }

    public function detail($id)
    {
        $where = array('is_del' => 0);
        $this->db->where($where);
        $this->db->where('id', $id);
        return $this->db->get($this->table);
    }

    public function update($object, $where)
    {
        // return $this->db->affected_rows();
        $this->db->trans_start();
        $this->db->where($where);
        $this->db->update($this->table, $object);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function get_qry($parameter)
    {
        // $where = array('is_del' => 0);
        // $this->db->where($where);
        // $this->db->where($parameter);
        return $this->db->query('select dc.*, u.name from documents dc join users u on dc.id_user = u.id 
        where dc.is_del = 0 and dc.id = '.$parameter);
        return $this->db->get($this->view);
    }


    public function get_by($parameter)
    {
        $where = array('is_del' => 0);
        $this->db->where($where);
        $this->db->where($parameter);
        return $this->db->get($this->view);
    }

    public function get_select($parameter)
    {
        // $where = array('is_del' => 0, 'STORE_ID' => $this->session->userdata('STORE_ID'));
        $STORE_ID = $this->session->userdata('STORE_ID');
        $this->db->select('*');
        $this->db->limit(10);
        $this->db->where("is_del = 0 AND STORE_ID = ". $STORE_ID." and ( SKU LIKE '%". $parameter."%' ESCAPE '!' OR NAME LIKE '%" . $parameter . "%' ESCAPE '!' )");
        // $this->db->like('SKU', $parameter);
        // $this->db->or_like('NAME', $parameter);
        return $this->db->get($this->view);
        // echo $this->db->get_compiled_select($this->view);
    }

    public function getMaxNumber($parameter){
        $where = array('is_del' => 0);
        $this->db->where($where);
        $this->db->where($parameter);
        return $this->db->count_all_results($this->table);
    }

    public function _uploadFile()
    {
        if (empty($_FILES["file_input"]["name"])) {
            $result = array(
                'status'           => true,
                'message'          => "Tidak ada gambar yg di upload",
                'original_image'   => null,
            );
            redirect('welcome');
        } else {
            $new_name = time()."_".$_FILES["file_input"]['name'];
            
            $config['upload_path']      = './assets/upload/';
            $config['allowed_types']    = 'pdf';
            $config['file_name']        = $new_name;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file_input')) {
                $result = array(
                    'status'          => true,
                    'message'         => "Upload Berhasil",
                    'original_image'  => $this->upload->data("file_name"),
                    'original_ext'    => $this->upload->data("file_ext"),
                );
                return $result;
            } else {
                $error = $this->upload->display_errors('', '');
                $result = array(
                    'status'          => false,
                    'message'         => $error,
                    'original_image'  => null,
                    'original_ext'    => null,
                );
                return $result;
            }
        }
    }

    public function _uploadFileServer()
    {
        if (empty($_FILES['pdf']['tmp_name'])) {
            $result = array(
                'status'           => true,
                'message'          => "Gagal",
                'original_image'   => null,
            );
            return $result;
        } else {
            $new_name = "(signed)".$_POST['filename'];
            
            $config['upload_path']      = $_SERVER['DOCUMENT_ROOT'] . '/tte/assets/upload/';
            $config['allowed_types']    = '*';
            $config['file_name']        = $new_name;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('pdf')) {
                $result = array(
                    'status'          => true,
                    'message'         => "Upload Berhasil",
                    'original_image'  => $this->upload->data("file_name"),
                    'original_ext'    => $this->upload->data("file_ext"),
                );
                return $result;
            } else {
                $error = $this->upload->display_errors('', '');
                $result = array(
                    'status'          => false,
                    'message'         => $error . "_" . $config['upload_path'],
                    'original_image'  => $new_name ,
                    'original_ext'    => $_FILES['pdf'],
                    '$config' => $config
                );
                return $result;
            }
        }
    }

    public function search($parameter)
    {

        $STORE_ID = $this->session->userdata('STORE_ID');
        $this->db->where("is_del = 0 AND STORE_ID = " . $STORE_ID . " and ( SKU LIKE '%" . $parameter . "%' ESCAPE '!' OR NAME LIKE '%" . $parameter . "%' ESCAPE '!' )");
        // $where = array('is_del' => 0, 'STORE_ID' => $this->session->userdata('STORE_ID'));
        // $this->db->where($where);
        // $this->db->like('NAME', $parameter);
        // $this->db->or_like('SKU', $parameter);
        return $this->db->get($this->view);
    }
}

