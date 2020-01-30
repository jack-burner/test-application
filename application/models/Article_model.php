<?php
class Article_model extends CI_Model {

    public $title;
    public $body;
    public $user_id;
    public $created_at;
    public $updated_at;

    public function getAll()
    {
        //Gets articles w/o user info
        $query = $this->db->get('articles');
        return $query->result();
    }

    public function getAllWithUsers()
    {
        //Gets articles with user info
        $final_result = [];
        // Query all Articles with join on users
        $this->db->select('articles.*, name, email');
        $this->db->from('articles');
        $this->db->join('users', 'users.id = articles.user_id');
        $query = $this->db->get();

        //Loop through each Article and get assign user with user's info in data structure
        foreach($query->result() as $row)
        {
            $final_result[] = 
            [
                'id' => $row->id,
                'title' => $row->title,
                'body' => $row->body,
                'user' =>
                [
                    'id' => $row->user_id,
                    'name' => $row->name,
                    'email' => $row->email,
                ],
                'created_at' => $row->created_at,
                'updated_at' => $row->updated_at

            ];
        }

        //return new query result
        return $final_result;
        
    }

    public function getOne($id)
    {
        //Get information about article for given id

        // Query articles with join on user
        $this->db->select('articles.*, name, email');
        $this->db->join('users', 'users.id = articles.user_id');
        $query = $this->db->get_where('articles', array('articles.id' => $id), 1);
        $row = $query->row();

        //modify row to return it in proper format
        return [
            'id' => $row->id,
            'title' => $row->title,
            'body' => $row->body,
            'user' =>
            [
                'id' => $row->user_id,
                'name' => $row->name,
                'email' => $row->email,
            ],
            'created_at' => $row->created_at,
            'updated_at' => $row->updated_at

        ];
    }

    public function insert($data)
    {
        return $this->db->insert('articles', $data);
    }

    public function update($id, $data)
    {

        $this->db->where('id', $id);
        return $this->db->update('articles', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('articles');
    }

}