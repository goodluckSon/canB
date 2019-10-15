@include('vendor/autoload.php')
@servers(['web' => '192.168.1.1', 'local'=>'localhost'])
@setup
    $slackHook      =   'https://hooks.slack.com/services/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';
    $slackChannel   =   '#phptask';
    $environment = isset($env) ? $env : "Development";
    $m = isset($m) ? $m : "Updates and Bug fixes";
    $slackmessage = isset($slackmessage) ? $slackmessage : "Git Commited as $m just now";
@endsetup

@story('gitcommit',['on' => 'local'])
    git_add
    git_comit
@endstory


@task('git_add')
    git add .
@endtask
@task('git_comit')
    git commit -m "{{$m}}"
@endtask

@task('slack',['on'=>'local'])
    echo "Sending Slack Message"
@endtask

@task('yarn',['on'=>'local'])
    @php
        $slackmessage = "Added Yarn Packages: $nodeapp"
    @endphp
    yarn add {{$nodeapp}}
@endtask

@finished
    @slack($slackHook, $slackChannel,"$slackmessage")
@endfinished