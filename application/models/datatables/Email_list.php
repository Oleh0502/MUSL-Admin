<?php
class Email_list extends CI_Model
{
    public $table = "emails";
    public $select_column = array(
        "Email_Id",
        "Email_Subject",
        "packages.Package_Name",
        "Email_Title",
        "Days"
    );
    public $order_column = array(
        "Email_Title",
        "packages.Package_Name",
        "Email_Subject",
        "Days",
       null
    );
    public function make_query()
    {
        $this->db->select($this->select_column)->join('packages',' packages.Package_Id = emails.Program_Id ','left');
        $this->db->from($this->table);
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
        $this->db->from($this->table)->join('packages',' packages.Package_Id = emails.Program_Id ','left')->where($where);
        return $this->db->count_all_results();
    }
}