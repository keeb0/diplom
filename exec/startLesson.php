<?php
session_start();

// sleep(10);
if (isset($_SESSION['role']) and $_SESSION['role'] == 'Преподаватель') {
	$camera_name = 'iLook 320';
	$microphone_name = 'Микрофон (Audio_Device)';
	$command = 'C:/nginx/ffmpeg/bin/ffmpeg -f dshow -rtbufsize 40M -i video="'.$camera_name.'" -f ';
	$command .= 'dshow -rtbufsize 40M -i audio="'.$microphone_name.'" -c:v libx264 -c:a ';
	$command .= 'libmp3lame -ar 44100 -ac 2 -f flv "rtmp://localhost/live/mystream live=1"';
	exec($command);
}

// exec('C:/nginx/ffmpeg/bin/ffmpeg -f dshow -rtbufsize 40M -i video="iLook 320" -f dshow -rtbufsize 40M -i audio="Микрофон (Audio_Device)" -c:v libx264 -c:a libmp3lame -ar 44100 -ac 2 -f flv "rtmp://localhost/live/mystream live=1"');

// exec('C:/nginx/ffmpeg/bin/ffmpeg -re -i video.mp4 -c copy -f flv rtmp://localhost/live/mystream');
// $output = shell_exec('stop-process -processname sublime_text');
// echo $output;