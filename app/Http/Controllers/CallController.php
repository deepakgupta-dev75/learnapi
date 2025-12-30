<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallModel;
use Pusher\Pusher;
use Twilio\Rest\Client;
use Exception;

class CallController extends Controller
{
    protected $callModel;
    protected $pusher;
    protected $twilioClient;

    public function __construct()
    {
        $this->callModel = new CallModel();

        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );

        $this->twilioClient = new Client(env('TWILIO_SID'), env('TWILIO_TOKEN'));
    }

    //
    /**
    *  @OA\Get(
    *     path="/calls",
    *     tags={"Calls"},
    *     summary="Get list of Calls",
    *     description="Get paginated list of Calls with search, filter, and sorting options.",
    *     security={{"BearerAuth":{}}},
    *
    *     @OA\Parameter(name="page", in="query", description="Page No", @OA\Schema(type="integer", example=1)),
    *     @OA\Parameter(name="per_page", in="query", description="Per Page", @OA\Schema(type="integer", example=10)),
    *     @OA\Parameter(name="search", in="query", description="Searching", @OA\Schema(type="string", example="John")),
    *     @OA\Parameter(name="filter_status", in="query", description="Filter Status", @OA\Schema(type="string", example="active")),
    *     @OA\Parameter(name="sort_by", in="query", description="Sort By", @OA\Schema(type="string", example="name")),
    *     @OA\Parameter(name="sort_order", in="query", description="Sort Order", @OA\Schema(type="string", example="asc")),
    *
    *     @OA\Response(
    *         response=200,
    *         description="Successful operation",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="data", type="array",
    *                 @OA\Items(type="object",
    *                     @OA\Property(property="id", type="integer", example=1),
    *                     @OA\Property(property="name", type="string", example="John Doe"),
    *                     @OA\Property(property="email", type="string", example="john@example.com"),
    *                     @OA\Property(property="status", type="string", example="active")
    *                 )
    *             )
    *         )
    *     )
    * )
    */

    public function index()
    {
        return response()->json(['user1', 'user2']);
    }

    /**
     * @OA\Post(
     *     path="/calls",
     *     tags={"Calls"},
     *     summary="Create a user",
     *     description="Creates a new user in the system",
     *     security={{"BearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User created")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        return response()->json(['message' => 'User created'], 201);
    }

    /**
     * @OA\Put(
     *     path="/calls/{id}",
     *     tags={"Calls"},
     *     summary="Update a user",
     *     description="Updates an existing user's details",
     *     security={{"BearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="Updated Name"),
     *             @OA\Property(property="email", type="string", format="email", example="updated@example.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="User updated")
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'User updated']);
    }

    /**
     * @OA\Get(
     *     path="/calls/{id}",
     *     tags={"Calls"},
     *     summary="Get a user's details",
     *     description="Fetch a single user's details by ID",
     *     security={{"BearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the user to fetch",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", example="john@example.com")
     *         )
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */

    public function show($id)
    {
        return response()->json([
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/calls/{id}",
     *     tags={"Calls"},
     *     summary="Delete a user",
     *     description="Deletes a user by ID",
     *     security={{"BearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="User ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=204, description="Deleted successfully"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    
    public function destroy($id)
    {
        return response()->json(['message' => 'User deleted']);
    }

    // Test

    public function incomingCall()
    {
        $callerId = $this->request->getPost('callerId');   // Twilio callerId
        $calleeId = $this->request->getPost('calleeId');   // Twilio calleeId
        $callSid  = $this->request->getPost('CallSid');   // Twilio callType

        if (!$callerId || !$calleeId || !$callSid) {
            return $this->sendError('Invalid input', 400);
        }

        $data = [
            'caller_id' => $callerId,
            'callee_id' => $calleeId,
            'call_sid'  => $callSid,
            'call_type' => 'incoming',
            'status'    => 'ringing',
            'start_time'=> date('Y-m-d H:i:s'),
            'created_at'=> date('Y-m-d H:i:s')
        ];

        $callId = $this->callModel->saveCallDetails($data);

        // Notify callee
        $this->pusher->trigger(
            'my-channel',
            'incomingCall',
            [
                'callId'   => $callId,
                'callerId' => $callerId
            ]
        );

        return $this->sendResponse(['callId' => $callId], 'Incoming call');
    }


    public function outgoingCall()
    {
        $callerId = $this->request->getPost('callerId');
        $calleeId = $this->request->getPost('calleeId');

        if (!$callerId || !$calleeId) {
            return $this->sendError('Invalid input', 400);
        }

        $call = $this->twilioClient->calls->create(
            $calleeId,
            env('TWILIO_PHONE_NUMBER'),
            [
                'url' => url('twiml/connect'),
                'statusCallback' => url('twilio/status'),
                'statusCallbackEvent' => ['initiated','ringing','answered','completed']
            ]
        );

        $callId = $this->callModel->saveCallDetails([
            'caller_id' => $callerId,
            'callee_id' => $calleeId,
            'call_sid'  => $call->sid,
            'call_type' => 'outgoing',
            'status'    => 'initiated',
            'start_time'=> date('Y-m-d H:i:s'),
            'created_at'=> date('Y-m-d H:i:s')
        ]);

        return $this->sendResponse(['callId'=>$callId],'Outgoing call started');
    }

    public function acceptCall()
    {
        $callId = $this->request->getPost('callId');

        if (!$callId) {
            return $this->sendError('Invalid input', 400);
        }

        $this->callModel->updateCall($callId, [
            'status' => 'accepted'
        ]);

        $this->pusher->trigger(
            'my-channel',
            'callAccepted',
            ['callId' => $callId]
        );

        return $this->sendResponse([], 'Call accepted'); 
    }

    public function rejectCall()
    {
        $callId = $this->request->getPost('callId');

        if (!$callId) {
            return $this->sendError('Invalid input', 400);
        }

        $call = $this->callModel->getCallById($callId);

        // Hangup Twilio call
        $this->twilioClient->calls($call->call_sid)
            ->update(['status' => 'completed']);

        $this->callModel->updateCall($callId, [
            'status' => 'rejected',
            'end_time' => date('Y-m-d H:i:s')
        ]);

        $this->pusher->trigger(
            'my-channel',
            'callRejected',
            ['callId' => $callId]
        );

        return $this->sendResponse([], 'Call rejected');
    }

    // Call Status Lifecycle

    // initiated → ringing → accepted → completed
    //                 → rejected
    //                 → missed


    
    public function makeOutgoingCall()
    {
        try{
            $call = $this->client->calls->create(
                '+918887660611',              // To
                $this->from,                 // Twilio number
                [
                    'url' => url('twilio/handle-outgoing-call'),
                    'method' => 'POST',

                    'statusCallback' => url('twilio/voice-status-callback'),
                    'statusCallbackMethod' => 'POST',
                    'statusCallbackEvent' => ['initiated', 'ringing', 'answered', 'completed', 'busy', 'failed', 'no-answer']
                ]
            );

            return "Call initiated. SID: " . $call->sid;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function handleOutgoingCall()
    {
        $response = new VoiceResponse();

        $response->say('This is an automated call from our company.', ['voice' => 'alice'] );

        $response->pause(['length' => 1]);
        $response->say('Thank you. Goodbye.');

        $response->hangup();

        return $this->response()->setContentType('text/xml')->setBody((string) $response);
    }

    public function voiceStatusCallback()
    {
        $callSid = $this->request->getPost('CallSid');
        $status  = $this->request->getPost('CallStatus');

        // Example statuses:
        // initiated, ringing, in-progress, completed, busy, failed, no-answer

        Log('info', "Call {$callSid} status: {$status}");

        // Update DB here
        // $this->callModel->updateBySid($callSid, ['status' => $status]);

        return $this->response()->setStatusCode(200);
    }


    
    public function callStatusCallback()
    {
        $callSid    = $this->request->getPost('CallSid');
        $callStatus = $this->request->getPost('CallStatus');
        $from       = $this->request->getPost('From');
        $to         = $this->request->getPost('To');

        if (!$callSid || !$callStatus) {
            return $this->response()->setStatusCode(400);
        }
        // Log or handle the status update
        Log('info', "Call Status Update: SID: {$callSid}, Status: {$callStatus}, From: {$from}, To: {$to}");

        // Example: update DB
        // $this->callModel->updateBySid($callSid, [
        //     'status' => $callStatus
        // ]);

        return $this->response()->setStatusCode(200);
    }

    public function smsStatusCallback()
    {
        $messageSid    = $this->request->getPost('MessageSid');
        $messageStatus = $this->request->getPost('MessageStatus');
        $from          = $this->request->getPost('From');
        $to            = $this->request->getPost('To');

        if (!$messageSid || !$messageStatus) {
            return $this->response()->setStatusCode(400);
        }

        // Log or handle the status update
        Log('info', "SMS Status Update: SID: {$messageSid}, Status: {$messageStatus}, From: {$from}, To: {$to}");
        
        // Example: update DB
        // $this->smsModel->updateBySid($messageSid, [
        //     'status' => $messageStatus
        // ]);

        return $this->response()->setStatusCode(200);
    }

    public function recordingStatusCallback()
    {
        $recordingSid      = $this->request->getPost('RecordingSid');
        $recordingUrl      = $this->request->getPost('RecordingUrl');
        $recordingDuration = $this->request->getPost('RecordingDuration');
        $callSid           = $this->request->getPost('CallSid');
        $recordingStatus   = $this->request->getPost('RecordingStatus');

        if (!$recordingSid || !$callSid) {
            return $this->response()->setStatusCode(400);
        }

        Log('info', "Recording Update | RecordingSid: {$recordingSid} | CallSid: {$callSid} | Status: {$recordingStatus} | Duration: {$recordingDuration}s");

        // Example: save recording
        // $this->recordingModel->save([
        //     'recording_sid' => $recordingSid,
        //     'call_sid'      => $callSid,
        //     'recording_url' => $recordingUrl,
        //     'duration'      => $recordingDuration,
        //     'status'        => $recordingStatus,
        // ]);

        // Return a response to Twilio
        return $this->response()->setStatusCode(ResponseInterface::HTTP_OK);
    }


}
