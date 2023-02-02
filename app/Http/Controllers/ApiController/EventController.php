<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\Event;
use App\Models\EventAttenedes;
use App\Models\EventPermission;
use App\Models\UserEventItem;

class EventController extends BaseController
{
    public function EventStore (Request $request) 
        {
        //dd($request->all());
            $validator = Validator::make($request->all(), [

                'event_type' => 'required',
                'event_name' => 'required|date|before:today',
                'event_address' => 'required',
                'event_PhoneNumber' => 'required',
                'event_city' => 'required',
                'event_state' => 'required',
                'event_date' => 'required',
                'event_start' => 'required',
                'event_end' => 'required',
                'zip_code' => 'required',
                'latitude' => 'required',
                'longitude' => 'required',   
                
            ]);

            if ($validator->fails())
            {
                return $this->sendError('Validatoin Error',$validator->errors());
            }

            $event = Event::create($request->toArray());
            $success['event_name'] = $event->event_name;
            return $this->sendResponse($success,'Event Registrated Successfully');
        }

        public function EventEdit(Request $req,$id){   ///Update AND Details
            $eventedit = Event::find($id);
            return response()->json($eventedit,200);
        }

        public function EventUpdate(Request $req,$id)
        {  
            dd($req->all()); ///Update AND Details
                $validator = Validator::make($req->all(), [
                    'event_type' => 'required',
                    'event_name' => 'required|date|before:today',
                    'event_address' => 'required',
                    'event_PhoneNumber' => 'required',
                    'event_city' => 'required',
                    'event_state' => 'required',
                    'event_date' => 'required',
                    'event_start' => 'required',
                    'event_end' => 'required',
                    'zip_code' => 'required',
                    'latitude' => 'required',
                    'longitude' => 'required',  
                ]);
        
                $eventupdate = Event::find($id);
                $eventupdate->update($req->all());
                return $eventupdate;
                   
        }


        public function EventPermission (Request $request) 
            {
            //dd($request->all());
                $validator = Validator::make($request->all(), [
    
                    'event_id' => 'required',
                    'full_name' => 'required|date|before:today',
                    'email' => 'required',
                    'phonenumber' => 'required',
                    
                ]);
    
                if ($validator->fails())
                {
                    return $this->sendError('Validatoin Error',$validator->errors());
                }
    
                $event = EventPermission::create($request->toArray());
                $success['event_name'] = $event->event_name;
                return $this->sendResponse($success,'Event Registrated Successfully');
            }

            public function Attenedess (Request $request) 
            {
                //dd($request->all());
                    $validator = Validator::make($request->all(), [
        
                        'attending' => 'required',
                        'user_id' => 'required|date|before:today',
                        'event_id' => 'required',
                        'attendsindicator' => 'required',
                        
                    ]);
        
                    if ($validator->fails())
                    {
                        return $this->sendError('Validatoin Error',$validator->errors());
                    }
        
                    $event = EventAttenedes::create($request->toArray());
                    $success['event_name'] = $event->event_name;
                    return $this->sendResponse($success,'Event Registrated Successfully');
            }
                public function UserEventItem (Request $request) 
                {
                    //dd($request->all());
                        $validator = Validator::make($request->all(), [
            
                            
                            'user_id' => 'required',
                            'item_id' => 'required',
                            'event_id' => 'required',
                            
                        ]);
            
                        if ($validator->fails())
                        {
                            return $this->sendError('Validatoin Error',$validator->errors());
                        }
            
                        $event = UserEventItem::create($request->toArray());
                        $success['event_name'] = $event->event_name;
                        return $this->sendResponse($success,'Event Registrated Successfully');
                }
}
