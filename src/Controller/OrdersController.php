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
        'limit' => 20,
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
        $this->Cookie->configKey('taxrate', 'path', '/');
        $this->Cookie->configKey('taxrate', ['encryption'=>false, 'httpOnly' => false]);
        
        $this->Cookie->configKey('dough', 'path', '/');
        $this->Cookie->configKey('dough', ['encryption'=>false, 'httpOnly' => false]);
        
        $this->Cookie->configKey('crust', 'path', '/');
        $this->Cookie->configKey('crust', ['encryption'=>false, 'httpOnly' => false]);
    }
    
     /**
     * Index method
     *
     * @return void
     */
    
    public function index()
    {   
        if ($this->request->session()->read('Auth.User.role')=='employee') {
            $orders = $this->Orders->find('all')
                            ->contain(['Users'])
                            ->order(['iscompleted' => 'ASC','orderdate' => 'DESC']);
        } else {
            $orders = $this->Orders->find('all')
                ->contain(['Users'])
                ->order(['iscompleted' => 'ASC','orderdate' => 'DESC'])
                ->where(['Orders.user_id' => $this->request->session()->read('Auth.User.user_id')]);
        } 
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
        //this is for processing customer can add their own, employee can add any user's
        if ($id == null) {
            if(is_null($this->request->session()->read('Auth.User.user_id'))){
                $this->Flash->error(__('Unauthorized Access.'));
            } else {
                $id = $this->request->session()->read('Auth.User.user_id');
            }
        }
        
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
                return $this->redirect(['action' => 'view', $order['order_id']]);
            } else {
                $this->Flash->error(__('The order could not be saved. Please, try again.'));
            }
        }

        $user = $this->Orders->Users->get($id);
        $doughsize = $this->Orders->Doughsize->find('list', ['keyField' => 'size',
                            'valueField' => 'price'],['limit' => 20])->toArray();
        //to display list with price
        foreach ($doughsize as $x => $x_value) {
            $doughsize_w_price[$x] = $x.': $'.$x_value;
        }
        
        $crustname = $this->Orders->Cruststyle->find('list', ['keyField' => 'name',
                            'valueField' => 'price'],['limit' => 20])->toArray();
        //to display list with price
        foreach ($crustname as $x => $x_value) {
            $crustname_w_price[$x] = $x.': $'.$x_value;
        }
        
        $this->loadModel('Topping');
        $cheese = $this->Topping->find('list',['keyField' => 'topping_id',
                            'valueField' => 'name'],['limit' => 20])
                    ->where(['category' => "CHEESE"])
                    ->order(['topping_id' => 'ASC'])
                    ->toArray();

        $meat = $this->Topping->find('list',['keyField' => 'topping_id',
                            'valueField' => 'name'],['limit' => 20])
                    ->where(['category' => "MEAT"])
                    ->order(['topping_id' => 'ASC'])
                    ->toArray();

        $veggie = $this->Topping->find('list',['keyField' => 'topping_id',
                            'valueField' => 'name'],['limit' => 20])
                    ->where(['category' => "VEGGIE"])
                    ->order(['topping_id' => 'ASC'])
                    ->toArray();
        
        $this->loadModel('Province');
        $taxrate = $this->Province->find()
                    ->select(['taxrate'])
                    ->where(['name' => $user->province])
                    ->first()
                    ->toArray();
        $taxrate = implode($taxrate);
        $this->Cookie->write('taxrate', $taxrate);
        
        $this->Cookie->write('dough', $doughsize);
        
        $this->Cookie->write('crust', $crustname);
        
        $this->set(compact('order', 'user', 'doughsize_w_price', 'crustname_w_price', 'cheese', 'meat', 'veggie', 'taxrate'));
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
        $user = $this->Orders->Users->get($order->user_id);
        
        $this->loadModel('Topping');
        $doughsize = $this->Orders->Doughsize->find('list', ['keyField' => 'size',
                            'valueField' => 'price'],['limit' => 20])->toArray();
        //to display list with price
        foreach ($doughsize as $x => $x_value) {
            $doughsize_w_price[$x] = $x.': $'.$x_value;
        }
        
        $crustname = $this->Orders->Cruststyle->find('list', ['keyField' => 'name',
                            'valueField' => 'price'],['limit' => 20])->toArray();
        //to display list with price
        foreach ($crustname as $x => $x_value) {
            $crustname_w_price[$x] = $x.': $'.$x_value;
        }
        
        $cheese = $this->Topping->find('list',['keyField' => 'topping_id',
                            'valueField' => 'name'],['limit' => 20])
                    ->where(['category' => "CHEESE"])
                    ->order(['topping_id' => 'ASC'])
                    ->toArray();

        $meat = $this->Topping->find('list',['keyField' => 'topping_id',
                            'valueField' => 'name'],['limit' => 20])
                    ->where(['category' => "MEAT"])
                    ->order(['topping_id' => 'ASC'])
                    ->toArray();

        $veggie = $this->Topping->find('list',['keyField' => 'topping_id',
                            'valueField' => 'name'],['limit' => 20])
                    ->where(['category' => "VEGGIE"])
                    ->order(['topping_id' => 'ASC'])
                    ->toArray();

        $this->loadModel('Province');
        $taxrate = $this->Province->find()
                    ->select(['taxrate'])
                    ->where(['name' => $user->province])
                    ->first()
                    ->toArray();
        $taxrate = implode($taxrate);
        $this->Cookie->write('taxrate', $taxrate);
            
        $this->Cookie->write('dough', $doughsize);
        
        $this->Cookie->write('crust', $crustname);
        $this->set(compact('order', 'user', 'doughsize_w_price', 'crustname_w_price', 'cheese', 'meat', 'veggie', 'taxrate'));
    }
    /**
     * Complete method
     * To change order status to complete by updating iscomplete as true
     * @param string|null $id Order id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
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
     /**
     * isAuthorized method
     * Authorization depedning on role
     * @param string|null $id Order id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function isAuthorized($user)
    {
        if ($user['role'] == 'employee')
            return true;
        if (in_array($this->request->action, ['index', 'add']))
            return true;
        
        // The owner of an order can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete', 'view'])) {
            $order_id = (int)$this->request->params['pass'][0];
            if ($this->Orders->isOwnedBy($order_id, $user['user_id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
}
