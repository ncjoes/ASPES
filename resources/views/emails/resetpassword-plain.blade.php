<?php

echo $greeting, "\n\n";

echo implode("\n", $introLines), "\n\n";

echo "{$actionText}: {$actionUrl}", "\n\n";

echo implode("\n", $outroLines), "\n\n";

echo 'Regards,', "\n";
echo config('app.name'), " Team\n";

echo "\n\nDon't want to receive email updates? Click the link to unsubscribe ", url('unsubscribe/' . $notifiable->email);
