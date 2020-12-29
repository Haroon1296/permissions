<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Module;
use App\Operation;
use App\Privilege;
use DB;
use Validator;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
		$data['user_id'] = $id;
       $modules = Module::where('status',1)->get();
    	// echo "<pre>"; print_r($modules); die;
    	 $mod = array(); 
    	 $a = 0;
    	$m_s_no = 1;
    	foreach ($modules as $module) 
    	{ 	  
    	 
         $operations = Operation::where([['module_id',$module->id],['status',1]])->get();
    	
   		  $mod[$a]['m_s_no']  = $m_s_no;
          $mod[$a]['module_name'] = $module->module_name;
          $mod[$a]['module_slug'] = $module->module_slug;
          
          $b = 0;
          
           $operat = array();
          $o_s_no = 1;
          foreach ($operations as $operation) 
          {
		   $operat[$b]['o_s_no'] = $m_s_no.'.'.$o_s_no;
           $operat[$b]['op_id'] = $operation->id;
           $operat[$b]['operation_name'] = $operation->operation_name;
           $operat[$b]['operation_slug'] = $operation->operation_slug;
           $operat[$b]['is_view_visible'] =$operation->is_view_visible;
           $operat[$b]['is_add_visible'] = $operation->is_add_visible;
           $operat[$b]['is_edit_visible'] = $operation->is_edit_visible;
           $operat[$b]['is_delete_visible'] = $operation->is_delete_visible;
           
           $privileges = Privilege::where([['user_id',$id],['operation_id',$operation->id],['status',1]])->get();
        	
        	$privi = array();
        	
        	   $privi[$b]['is_add'] =  0;
	           $privi[$b]['is_edit'] =  0;
	           $privi[$b]['is_view'] =  0;
	           $privi[$b]['is_delete'] =  0;


        	foreach ($privileges as  $privilege) {
				
	           $privi[$b]['privilege_id'] = $privilege->id;
	           $privi[$b]['is_add'] = $privilege->is_add;
	           $privi[$b]['is_edit'] = $privilege->is_edit;
	           $privi[$b]['is_view'] = $privilege->is_view;
	           $privi[$b]['is_delete'] = $privilege->is_delete;

        	}
        
        
        

          	$operat[$b]['privileges'] = $privi;  
        
           $o_s_no++;
           $b++;
          }

        $mod[$a]['operations'] = $operat;  
        $m_s_no++;
    	$a++;
    	}
    	$data['data'] = $mod;
		//dd($data);
    	return view('permission', $data);
    }

    public function get_ladger(Request $request){
    	$output = array();
    	$data = $request->all();
        $desc_id = $request->desc_id;
        $record_date_from = $request->record_date_from;
        $record_date_to = $request->record_date_to;
        $description = Description::where('id', '=', $desc_id)->first();
        $new = '';
		 if($record_date_from!=null && $record_date_to!=null)
		   {
		   		$record_date_from = date('d-m-Y 00:00:00', strtotime($record_date_from));
				 //$record_date_from = date_format($record_date_from,"m-d-Y");
				 $record_date_to = date('d-m-Y 23:59:59', strtotime($record_date_to));
				 //$record_date_to = date_format($record_date_to,"m-d-Y");

	        	$voucher = Voucher::where('vouchers.ch_description_id', '=', $desc_id)
		        	->join('transactions as transactions', 'transactions.voucher_id', '=', 'vouchers.voucher_id')
		        	->join('ch_descriptions as ch_descriptions', 'ch_descriptions.id', '=', 'vouchers.ch_description_id')
		        	->whereBetween('transactions.transaction_date', [$record_date_from, $record_date_to])
		        	->where('transactions.payment_type', '!=','null')
		            ->orderBy('transactions.transaction_date', 'ASC')
		            ->select('transactions.*','vouchers.classification as classification','vouchers.ch_description_id as ch_description_id','vouchers.voucher_date as voucher_date','ch_descriptions.description as description_name','ch_descriptions.opening_balance as opening_balance')
	        		->get();

	        		$debit =  Voucher::where('vouchers.ch_description_id', '=', $desc_id)
	        		->join('transactions as transactions', 'transactions.voucher_id', '=', 'vouchers.voucher_id')
		        	->join('ch_descriptions as ch_descriptions', 'ch_descriptions.id', '=', 'vouchers.ch_description_id')
		        	->where('transactions.transaction_date', '<' ,$record_date_from)
		            ->where('transactions.type', '=','debit')
		        	->where('transactions.payment_type', '!=','null')
		           // ->select( DB::raw('SUM(transactions.amount) as debit'))
		            ->sum('transactions.amount');
		         
	        		$credit =  Voucher::where('vouchers.ch_description_id', '=', $desc_id)
	        		->join('transactions as transactions', 'transactions.voucher_id', '=', 'vouchers.voucher_id')
		        	->join('ch_descriptions as ch_descriptions', 'ch_descriptions.id', '=', 'vouchers.ch_description_id')
		            ->where('transactions.transaction_date', '<',$record_date_from)
		            ->where('transactions.type', '=','credit')
		        	->where('transactions.payment_type', '!=','null')
		            ->sum('transactions.amount');

		            $op_balance =  Voucher::where('vouchers.ch_description_id', '=', $desc_id)
	        		->join('transactions as transactions', 'transactions.voucher_id', '=', 'vouchers.voucher_id')
		        	->join('ch_descriptions as ch_descriptions', 'ch_descriptions.id', '=', 'vouchers.ch_description_id')
		            ->first('ch_descriptions.opening_balance');

	        	$new =  ($op_balance->opening_balance + $debit ) - $credit;
	        }
	        else{
			 $voucher = Voucher::where('vouchers.ch_description_id', '=', $desc_id)
	        	->join('transactions as transactions', 'transactions.voucher_id', '=', 'vouchers.voucher_id')
	        	->join('ch_descriptions as ch_descriptions', 'ch_descriptions.id', '=', 'vouchers.ch_description_id')
	        	->where('transactions.payment_type', '!=','null')
	            ->orderBy('transactions.transaction_date', 'ASC')
	            ->select('transactions.*','vouchers.classification as classification','vouchers.ch_description_id as ch_description_id','vouchers.voucher_date as voucher_date','ch_descriptions.description as description_name','ch_descriptions.opening_balance as opening_balance')
	        	->get();
	        	$new = intval($voucher[0]->opening_balance);
        }
         //$new = intval($voucher[0]->opening_balance);
        	$html = '';
        	$html_date = '';
        	$error = '';
        	$html_foot = '';
        	$op_bal = '';
        	if(count($voucher)>0){
	         $html .= '
	              <tr>
	                <td>
	                    <table>
	                        <tbody>
	                            <tr>
	                                <td>'.$voucher[0]->voucher_date.'</td>
	                                <td>-</td>
	                                <td></td>
	                            </tr>
	                            <tr>
	                                <td>Opening</td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </td>
	                <td>---</td>
	                <td>
	                	---
	                </td>
	                <td>---</td>
	                <td>---</td>
	                <td class="op_bal">'.$new .'</td>
	              </tr>';
             //$balance  =  intval($voucher[0]->opening_balance);
             $balance  =  $new;
             $new_bal = 0;
             $sum = 0;
             $old_debit = 0;
             $old_credit = 0;
	        	foreach ($voucher as $value) 
	        	{
	        		$credit = 0;
	        		$debit = 0;
		        	$amount_credit = 0;

		        	if($value->type=='credit'){
		        		$amount_credit =  $value->amount;
		        		$credit =  intval($amount_credit);
		        		$old_credit = $old_credit + $credit ; 
		        	}else
		        	{
		        		$credit = 0;
		        	}

		        	$amount_debit = 0;
			 		if($value->type=='debit'){
						$amount_debit =  $value->amount;
						$debit =  intval($amount_debit);
		        		$old_debit = $old_debit + $debit ; 
			 		}
			 		else
			 		{
			 			$debit = 0;	
			 		}

				  if($sum==0){
				  	$old_bal  =  ($balance + $debit) - $credit;	

				  }else{
				  		$old_bal  =  $debit - $credit;	
				  }
					$new_bal  =  $new_bal + $old_bal ;	
					
					$description_party = Description::where('id', '=', $value->party)->first();
					$transaction_date = explode(' ', $value->transaction_date);

	    			$html.= '<tr>
                    <td>
                        <table>
                            <tbody>
                                <tr>
                                    <td>'.$transaction_date[0] .' </td>
                                    <td> &nbsp;&nbsp;  -  &nbsp;&nbsp; </td>
                                    <td> '. $value->voucher_id.'</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>'.ucwords($value->classification).'</td>
                    <td>'.$description_party->description.'<hr style="margin-top: 0px;">'.$value->remarks.'</td>
                    <td>'.$debit.'</td>
                    <td>'.$credit.'</td>
                    <td>'.$new_bal.'</td>
                  </tr>';
		            $sum++;
	        	}
	        	$html_foot ='<tr>
	        		<td></td>
	        		<td></td>
	        		<td></td>
	        		<td>Total Debit:<b> '.$old_debit.'</b></td>
	        		<td>Total Credit:<b> '.$old_credit.'</b></td>
	        		<td>Total Balance:<b> '.$new_bal.'<b></td>
        		</tr>';
            }else{
         		$error = '<div align="center"><h5><i>No Data</i></h5></div>';
         	}
     	$output = array(
     	  	't_body' => $html ,
     		't_foot' => $html_foot ,
     		'error' => $error ,
     		 );
       echo json_encode($output);
	}
	
	public function store(Request $request){
		//
		$user_privileges = Privilege::where('user_id', $request->user_id)->first();
		
		if(empty($user_privileges)){
			// Create
			foreach($request->operation as $count => $operation){
				//
				$data = [
					'user_id' => $request->user_id,
					'operation_id' => $operation,
					'is_edit' => isset($request->is_edit[$count]) ? $request->is_edit[$count] : 0,
					'is_view' => isset($request->is_view[$count]) ? $request->is_view[$count] : 0,
					'is_add' => isset($request->is_add[$count]) ? $request->is_add[$count] : 0,
					'is_delete' => isset($request->is_delete[$count]) ? $request->is_delete[$count] : 0,
					'status' => 1
				];
				Privilege::create($data);
			}
			return redirect()->back();
		}else{
			// Update
			foreach($request->operation as $count => $operation){
				//
				$data = [
					'is_edit' => isset($request->is_edit[$count]) ? $request->is_edit[$count] : 0,
					'is_view' => isset($request->is_view[$count]) ? $request->is_view[$count] : 0,
					'is_add' => isset($request->is_add[$count]) ? $request->is_add[$count] : 0,
					'is_delete' => isset($request->is_delete[$count]) ? $request->is_delete[$count] : 0,
					'status' => 1
				];
				Privilege::where('operation_id', $operation)->where('user_id', $request->user_id)->update($data);
			}
			return redirect()->back();
		}
	}

    
}
