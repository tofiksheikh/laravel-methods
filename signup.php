use Hash;
use Auth;
use Validator;


public function createAccount(Request $request){
    
        
       
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:'users',
            'first_name' => 'required|string|max:50',
            'phone' => 'required|integer|min:10',
            'password' => 'required'
        ]);
         
        if ($validator->fails()) {
           
             return response()->json(['status' => 'failed','message' => $validator->messages()->first(), ]);

        }else{
           $password = Hash::make($request->password);
           
           $user= new Users;
           $user->email = $request->email;
           $user->password = $password;
           $user->phone = $request->phone;
           $user->first_name = $request->first_name;
           $user->user_type = 1;
           $user->save();
       
       if($user->save()){
           return response()->json([
               'status' => 'success',
                'message' => 'Tutor Register Succefull',
                'redirect_uri' => '/', 
                'data' => $user ]);
        }else{
            return response()->json([
                'status' => 'failed',
                 'message' => 'Somthing went wrond',
                 'redirect_uri' => '/', 
                 'data' => '' ]);
       }
       
    }
       }