<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    public $paginate = [
        'Orders' => [],
        'Users' => [],
        'Doughsize' => [],
        'Cruststyle' => [],
        'sortWhitelist' => [
            'order_id', 'Users.name', ' orderdate', 'modified', 'iscompleted'
        ],
        'limit' => 5,
        'order' => [
            'Orders.iscompleted' => 'desc',
            'Orders.order_id' => 'asc',
            'Orders.modified' => 'asc'
        ]
    ];
    
    
    /* Initialize */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Paginator');
    }
    
    /**
     * Index method
     *
     * @return void
     */
    
    public function index()
    {
        $orders = $this->Orders->find('all')->contain(['Users']);
        $this->set('orders', $this->paginate($orders));
        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id,['contain' => ['Users']]);
        $this->set(compact('order'));
    }

    /**
     * Add method
     * Adding order should be based on existing user
     * So, new order will be routed to user list and there, new order will be placed
     * Uesr email will be shown at order list
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
        $order = $this->Orders->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['user_id'] = $id;
            $order = $this->Orders->patchEntity($order, $this->request->data);
        
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $user = $this->Orders->Users->get($id);
        $doughsize = $this->Orders->Doughsize->find('list', ['limit' => 200]);
        $crustname = $this->Orders->Cruststyle->find('list', ['limit' => 200]);
        $this->set(compact('order', 'user', 'doughsize', 'crustname'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id,['contain' => ['Users']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        
        $doughsize = $this->Orders->Doughsize->find('list', ['limit' => 200]);
        $crustname = $this->Orders->Cruststyle->find('list', ['limit' => 200]);
        $this->set(compact('order', 'doughsize', 'crustname'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return void Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
