<?php

echo "Hi $notifiable->first_name!", "\n\n";

echo 'Welcome to ', config('app.name'), "! Lets get started.\n\n";
echo config('app.name'), ' gives you access to unlimited books and other published works for free!', "\n";
echo 'For more fun, you can also upload your books and publications to reach an even wider audience. '
 . 'Join groups created by authors of publications to discuss, ask questions and give feedback.', "\n\n";

echo "Start reading here: ", url('/explorer'), "\n";
echo "Start uploading here: ", url()->route('app.upload'), "\n\n";

echo "If you have questions, send us a mail at support@reedaa.com. We'd be glad to help!\n\n";

echo 'Regards,', "\n";
echo config('app.name'), " Team\n";
echo "\n\nDon't want to receive email updates? Click the link to unsubscribe ", url('unsubscribe/' . $notifiable->email);
