class UserController extends Controller {

public function AuthRouteAPI(Request $request){
    return $request->user();
 }
 
}