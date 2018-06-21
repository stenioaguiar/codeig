<?php
class Clientes_Model extends MY_Model {
	
	// Variável que define o nome da tabela
  var $table = "";
  /**
  * Método Construtor
  */
  /**
  * Insere um registro na tabela
  *
  * @param array $data Dados a serem inseridos
  *
  * @return boolean
  */
  function Inserir($data) {
    if(!isset($data))
      return false;
    return $this->db->insert($this->table, $data);
  }
  /**
  * Recupera um registro a partir de um ID
  *
  * @param integer $id ID do registro a ser recuperado
  *
  * @return array
  */
  function GetById($id) {
    if(is_null($id))
      return false;
    $this->db->where('id', $id);
    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return null;
    }
  }
  /**
  * Lista todos os registros da tabela
  *
  * @param string $sort Campo para ordenação dos registros
  *
  * @param string $order Tipo de ordenação: ASC ou DESC
  *
  * @return array
  */
  function GetAll($sort = 'id', $order = 'asc') {
    $this->db->order_by($sort, $order);
    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }
  /**
  * Atualiza um registro na tabela
  *
  * @param integer $int ID do registro a ser atualizado
  *
  * @param array $data Dados a serem inseridos
  *
  * @return boolean
  */
  function Atualizar($id, $data) {
    if(is_null($id) || !isset($data))
      return false;
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }
  /**
  * Remove um registro na tabela
  *
  * @param integer $int ID do registro a ser removido
  *
  *
  * @return boolean
  */
  function Excluir($id) {
    if(is_null($id))
      return false;
    $this->db->where('id', $id);
    return $this->db->delete($this->table);
  }
    function __construct() {
        parent::__construct();
        $this->table = 'cliente';
    }
    /**
    * Formata os clientes para exibição dos dados na home
    *
    * @param array $cliente Lista dos clientes a serem formatados
    *
    * @return array
    */
    function Formatar($cliente){
      if($cliente){
        for($i = 0; $i < count($cliente); $i++){
          $cliente[$i]['editar_url'] = base_url('editar')."/".$cliente[$i]['id'];
          $cliente[$i]['excluir_url'] = base_url('excluir')."/".$cliente[$i]['id'];
        }
        return $cliente;
      } else {
        return false;
      }
    }
}