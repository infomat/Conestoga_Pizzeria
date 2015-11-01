<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
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
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['login']);
    }
    
    /**
     * Index method
     *
     * @return void
     */
    
    public function index()
    {   
        //pr($this->Auth->user());
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
        $this->loadModel('Topping');
        $topping_name_ar=array();
        if ($order->toppings != null){
            $topping_ar=array();
            $topping_ar = explode(',',$order->toppings);
           
            foreach ($topping_ar as $item):
                $toppinglist = $this->Topping->get($item);
                array_push($topping_name_ar,$toppinglist->name);
            endforeach;
        }
        $this->set(compact('order','topping_name_ar'));
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
            $order->email = $this->Auth->user('email');
            if ($this->request->data['veggie']!=null)
                $order->toppings = implode(',',$this->request->data['veggie']);
            if ($this->request->data['meat']!=null)
                $order->toppings = $order->toppings.','.implode(',',$this->request->data['meat']);
            if ($this->request->data['cheese']!=null)
                $order->toppings = $order->toppings.','.implode(',',$this->request->data['cheese']);

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
        $this->loadModel('Topping');
        $cheese = $this->Topping->find()
                    ->select(['topping_id', 'name'])
                    ->where(['category' => "CHEESE"])
                    ->order(['topping_id' => 'ASC']);

        $meat = $this->Topping->find()
                    ->select(['topping_id', 'name'])
                    ->where(['category' => "MEAT"])
                    ->order(['topping_id' => 'ASC']);

        $veggie = $this->Topping->find()
                    ->select(['topping_id', 'name'])
                    ->where(['category' => "VEGGIE"])
                    ->order(['topping_id' => 'ASC']);
        
        $this->set(compact('order', 'user', 'doughsize', 'crustname','cheese','meat','veggie'));

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
            if ($this->request->data['veggie']!=null)
                $order->toppings = implode(',',$this->request->data['veggie']);
            if ($this->request->data['meat']!=null)
                $order->toppings = $order->toppings.','.implode(',',$this->request->data['meat']);
            if ($this->request->data['cheese']!=null)
                $order->toppings = $order->toppings.','.implode(',',$this->request->data['cheese']);
            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }
        $this->loadModel('Topping');
        $doughsize = $this->Orders->Doughsize->find('list', ['limit' => 200]);
        $crustname = $this->Orders->Cruststyle->find('list', ['limit' => 200]);
        
        $cheese = $this->Topping->find()
                    ->select(['topping_id', 'name'])
                    ->where(['category' => "CHEESE"])
                    ->order(['topping_id' => 'ASC']);

        $meat = $this->Topping->find()
                    ->select(['topping_id', 'name'])
                    ->where(['category' => "MEAT"])
                    ->order(['topping_id' => 'ASC']);

        $veggie = $this->Topping->find()
                    ->select(['topping_id', 'name'])
                    ->where(['category' => "VEGGIE"])
                    ->order(['topping_id' => 'ASC']);
        
        $this->set(compact('order', 'doughsize', 'crustname','crustname','cheese','meat','veggie'));
    }
    
    public function complete($id = null)
    {
        $order = $this->Orders->get($id,['contain' => ['Users']]);
        $this->request->data['iscompleted'] = 1;
        if ($this->request->is(['patch', 'post', 'put'])) {

            $order = $this->Orders->patchEntity($order, $this->request->data);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been completed.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The order could not be complted. Please, try again.'));
            }
        }
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
    
    public function isAuthorized($user)
    {
        if ($user['role'] == 'employee') 
            return true;
        // All registered users can add orders
        if ($this->request->action === 'add') {
            return true;
        }
        // The owner of an order can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {
            $order_id = (int)$this->request->params['pass'][0];
            
            //TODO
            //ERRRORUndefined variable: order_id [APP/Controller\OrdersController.php, line 172]
            if ($this->Orders->isOwnedBy($order_id, $user['user_id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
}
