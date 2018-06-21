<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base extends CI_Controller {
	/**
     * Carrega a home
     */
	public function Index()
	{
		$this->load->model('Clientes_Model');
		// Recupera os clientes através do model
		$cliente = $this->Clientes_Model->GetAll('nome');
		// Passa os cliente para o array que será enviado à home
		$dados['cliente'] =$this->Clientes_Model->Formatar($cliente);
		// Chama a home enviando um array de dados a serem exibidos
		$this->load->view('home',$dados);
	}
	/**
     * Processa o formulário para salvar os dados
     */
	public function Salvar(){
		// Recupera os clientes através do model
		$cliente = $this->Clientes_Model->GetAll('nome');
		// Passa os clientes para o array que será enviado à home
		$dados['cliente'] =$this->Clientes_Model->Formatar($cliente);
		// Executa o processo de validação do formulário
		$validacao = self::Validar();
		// Verifica o status da validação do formulário
		// Se não houverem erros, então insere no banco e informa ao usuário
		// caso contrário informa ao usuários os erros de validação
		if($validacao){
			// Recupera os dados do formulário
			$cliente_ = $this->input->post();
			// Insere os dados no banco recuperando o status dessa operação
			$status = $this->Clientes_Model->Inserir($cliente_);
			// Checa o status da operação gravando a mensagem na seção
			if(!$status){
				$this->session->set_flashdata('error', 'Não foi possível inserir o cliente.');
			}else{
				$this->session->set_flashdata('success', 'Cliente inserido com sucesso.');
				// Redireciona o usuário para a home
				redirect();
			}
		}else{
			$this->session->set_flashdata('error', validation_errors('<p>','</p>'));
		}
		// Carrega a home
		$this->load->view('home',$dados);
	}
	/**
     * Carrega a view para edição dos dados
     */
	public function Editar(){
		// Recupera o ID do registro - através da URL - a ser editado
		$id = $this->uri->segment(2);
		// Se não foi passado um ID, então redireciona para a home
		if(is_null($id))
			redirect();
		// Recupera os dados do registro a ser editado
		$dados['cliente_'] = $this->Clientes_Model->GetById($id);
		// Carrega a view passando os dados do registro
		$this->load->view('editar',$dados);
	}
	/**
     * Processa o formulário para atualizar os dados
     */
	public function Atualizar(){
		// Realiza o processo de validação dos dados
		$validacao = self::Validar('update');
		// Verifica o status da validação do formulário
		// Se não houverem erros, então insere no banco e informa ao usuário
		// caso contrário informa ao usuários os erros de validação
		if($validacao){
			// Recupera os dados do formulário
			$cliente_ = $this->input->post();
			// Atualiza os dados no banco recuperando o status dessa operação
			$status = $this->Clientes_Model->Atualizar($cliente_['id'],$cliente_);
			// Checa o status da operação gravando a mensagem na seção
			if(!$status){
				$dados['cliente_'] = $this->Clientes_Model->GetById($cliente_['id']);
				$this->session->set_flashdata('error', 'Não foi possível atualizar o contato.');
			}else{
				$this->session->set_flashdata('success', 'Contato atualizado com sucesso.');
				// Redireciona o usuário para a home
				redirect();
			}
		}else{
			$this->session->set_flashdata('error', validation_errors());
		}
		// Carrega a view para edição
		$this->load->view('editar',$dados);
	}
	/**
     * Realiza o processo de exclusão dos dados
     */
	public function Excluir(){
		// Recupera o ID do registro - através da URL - a ser editado
		$id = $this->uri->segment(2);
		// Se não foi passado um ID, então redireciona para a home
		if(is_null($id))
			redirect();
		// Remove o registro do banco de dados recuperando o status dessa operação
		$status = $this->Clientes_Model->Excluir($id);
		// Checa o status da operação gravando a mensagem na seção
		if($status){
			$this->session->set_flashdata('success', '<p>Cliente excluído com sucesso.</p>');
		}else{
			$this->session->set_flashdata('error', '<p>Não foi possível excluir o Cliente.</p>');
		}
		// Redirecionao o usuário para a home
		redirect();
	}
	/**
	* Valida os dados do formulário
	*
	* @param string $operacao Operação realizada no formulário: insert ou update
	*
	* @return boolean
	*/
	private function Validar($operacao = 'insert'){
		// Com base no parâmetro passado
		// determina as regras de validação
		switch($operacao){
			case 'insert':
				$rules['nome'] = array('trim', 'required', 'min_length[3]');
				$rules['endereco'] = array('trim', 'required', 'min_length[5]');
				$rules['telefone'] = array('trim', 'required', 'min_length[6]');
				$rules['email'] = array('trim', 'required', 'valid_email', 'is_unique[cliente.email]');
				break;
			case 'update':
				$rules['nome'] = array('trim', 'required', 'min_length[3]');
				$rules['endereco'] = array('trim', 'required', 'min_length[5]');
				$rules['telefone'] = array('trim', 'required', 'min_length[6]');
				$rules['email'] = array('trim', 'required', 'valid_email');
				break;
			default:
				$rules['nome'] = array('trim', 'required', 'min_length[3]');
				$rules['endereco'] = array('trim', 'required', 'min_length[5]');
				$rules['telefone'] = array('trim', 'required', 'min_length[6]');
				$rules['email'] = array('trim', 'required', 'valid_email', 'is_unique[cliente.email]');
				break;
		}
		$this->form_validation->set_rules('nome', 'Nome', $rules['nome']);
		$this->form_validation->set_rules('endereco', 'Endereco', $rules['endereco']);
		$this->form_validation->set_rules('telefone', 'Telefone', $rules['telefone']);
		$this->form_validation->set_rules('email', 'Email', $rules['email']);
		// Executa a validação e retorna o status
		return $this->form_validation->run();
	}
}