<?php
class Supplier_list extends CI_Model
{
    public $table = "users u";
    public $select_column = array(
        "u.User_Id",
        "u.Is_Deleted",
        "u.Company",
        "u.User_Last_Name",
        "u.User_Email",
        "u.Role",
        "u.User_Image",
        "u.User_Phone",
        "u.Company",
        "u.Created_Date",
        "u.Is_Blocked"
    );
    public $order_column = array(
        "u.Company",
        // "u.User_Last_Name",
        "u.User_Email",
        "u.User_Phone",
        // "u.Company",
        "u.Created_Date",
        null
    );
    public function make_query()
    {
        $this->db->select($this->select_column);
        $this->db->from($this->table)->join('roles r','r.Role_Id=u.Role','left');
        if (isset($_POST["search"]["value"]))
        {
            $wh = " (";
            foreach ($this->order_column as $column)
            {
                if (!empty($column))
                {
                    $wh .= " " . $column . " LIKE '%" . $_POST["search"]["value"] . "%' OR";
                }
            }

            $wh = rtrim($wh, "OR");
            $wh .= " )";
            $this->db->where($wh);
        }
		
		if (isset($_POST["order"]))
        {
            $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else
        {
            $this->db->order_by($this->select_column[0], 'DESC');
        }
    }

    public function make_datatables($where)
    {
        $this->make_query();
        if ($_POST["length"] != -1)
        {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->where($where)->get();
        return $query->result();
    }

    public function get_filtered_data($where)
    {
        $this->make_query();
        $query = $this->db->where($where)->get();
        return $query->num_rows();
    }

    public function get_all_data($where)
    {
        $this->db->select("*");
        $this->db->from($this->table)->where($where);
        return $this->db->count_all_results();
    }
}
