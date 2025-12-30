## TwiML - Twilio Markup Language 

say()               Speak a message to the caller.
play()              Play an audio file (MP3, WAV) to the caller.
gather()            Collect user input via DTMF (keypad) or speech.
dial()              Connect the caller to another phone number, SIP endpoint, or Twilio client.
record()            Record audio from the caller.
hangup()            End the call.
redirect()          Redirect the call flow to another TwiML URL.
enqueue()           Put the caller in a queue to wait for an agent.
leave()             Remove caller from a queue.
pause()             Pause for a few seconds in the IVR.
conference()        Add caller to a conference room

refer -> Twilio initiates SIP REFER towards IP communication infrastructure.
reject -> Decline an incoming call without being billed.

$say = $response->say("Hello", [
    'voice' => 'alice',          // "alice" or "man", "woman" (default is "man")
    'language' => 'en-IN',       // Language for TTS
    'loop' => 1,                 // Number of times to repeat
]);

voice: 'alice', 'man', 'woman'

language: 'en-US', 'en-IN', 'hi-IN', etc.

loop: repeat the message N times

timeout: time before moving to next instruction



$response->play("https://example.com/audio/welcome.mp3", [
    'loop' => 2      // Repeat audio 2 times
]);

loop: Repeat audio N times


$response->play("https://example.com/audio/hold_music.mp3", ['loop' => 0]); // 0 → infinite loop




$gather = $response->gather([
    'input' => 'dtmf',            // 'dtmf', 'speech', or 'speech dtmf'
    'numDigits' => 1,             // Max digits to read
    'timeout' => 5,               // Time to wait for input (seconds)
    'speechTimeout' => 'auto',    // Auto speech detection
    'language' => 'en-IN',
    'action' => url('/ivr/menu'), // URL to handle input
    'method' => 'POST'
]);
$gather->say("Press 1 for Support, 2 for Sales.", ['voice'=>'alice']);


You must provide say() or play() inside gather().

Twilio waits for either DTMF or speech input.

After input, Twilio calls the action URL.



$response->dial('+911234567890', [
    'timeout' => 20,           // Max seconds to ring
    'callerId' => '+911112223334' // Caller ID to show
]);

record → record the call

timeLimit → max call duration

action → URL to hit after call ends

$response->say("Connecting you to Support...", ['voice'=>'alice']);
$response->dial('+911234567890', ['timeout'=>30, 'callerId'=>'+911112223334']);



$response->record([
    'maxLength' => 120,   // Max 2 minutes
    'playBeep' => true,   // Play beep before recording
    'timeout' => 5,       // Stop recording if silence detected
    'transcribe' => true, // Convert speech to text
    'transcribeCallback' => url('/ivr/transcription'), // URL to get transcription
    'finishOnKey' => '#', // End recording when '#' is pressed
    'trim' => 'trim-silence', // Remove silence
]);





$response->say("Goodbye!", ['voice'=>'alice']);
$response->hangup();



$response->redirect(url('/ivr/entry'), ['method'=>'POST']);



$response->enqueue('SupportQueue', [
    'waitUrl' => 'https://example.com/hold_music.xml' // Music while waiting
]);

Used with Twilio TaskRouter or agent system.

waitUrl can contain <Play> or <Say> instructions.



$response->leave();



$response->pause(['length'=>3]); // Pause 3 seconds



$response->dial()->conference('SupportRoom', [
    'beep' => 'true',
    'startConferenceOnEnter' => 'true'
]);




