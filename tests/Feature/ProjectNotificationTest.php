<?php

namespace Tests\Feature;

use App\User;
use App\Project;
use App\TimeLog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProjectIsAtFiftyPercentTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\ProjectIsAtEightyPercentTime;
use App\Notifications\ProjectIsAtOneHundredPercentTime;

class ProjectNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_project_owner_is_notified_once_a_project_hits_fifty_percent_time_used()
    {
        Notification::fake();
        // Given we have a Project
        $user = factory(User::class)->create();
        // total seconds is set to 1 HOUR below because of the mutator not being able to be disabled
        // @todo #helpneeded
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 1]);

        // Which is at 50% time
        $timelog = factory(TimeLog::class)->create([
            'number_of_seconds' => 1800, // 30 minutes
            'user_id' => $user->id,
            'project_id' => $project->id
        ]);

        // The project owner should receive a notification
        Notification::assertSentTo($user, ProjectIsAtFiftyPercentTime::class,
            function ($notification) use ($user, $project) {

                // An email should be sent
                $mailData = $notification->toMail($user)->toArray();
                $this->assertContains("Hey {$user->name}", $mailData['introLines'][0]);
                $this->assertContains("We just thought we'd let you know that your project {$project->title} on Trackr is at 50% time utilised.", $mailData['introLines'][1]);
                $this->assertEquals('Check Time Logs', $mailData['actionText']);
                $this->assertEquals(route('projects.show', $project), $mailData['actionUrl']);
                $this->assertContains('Thanks for using Trackr!', $mailData['outroLines'][0]);

                // And the notification should be stored in the DB
                $arrayData = $notification->toArray($user);
                $this->assertEquals("Trackr Bot", $arrayData['author']);
                $this->assertEquals("{$project->title} is at 50% time utilised!", $arrayData['title']);
                $this->assertEquals("{$project->title} is at 50% time utilised!", $arrayData['message']);
                $this->assertEquals(route('projects.show', $project), $arrayData['link']);

                return true;
            }
        );
    }

    public function test_a_project_owner_is_notified_once_a_project_hits_eighty_percent_time_used()
    {
        Notification::fake();
        // Given we have a Project
        $user = factory(User::class)->create();
        // total seconds is set to 1 HOUR below because of the mutator not being able to be disabled
        // @todo #helpneeded
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 1]);
        // Which is at 50% time
        $timelog = factory(TimeLog::class)->create([
            'number_of_seconds' => 2880, // 48 minutes
            'user_id' => $user->id,
            'project_id' => $project->id
        ]);
        // The project owner should receive a notification
        Notification::assertSentTo($user, ProjectIsAtEightyPercentTime::class,
            function ($notification) use ($user, $project) {

                // An email should be sent
                $mailData = $notification->toMail($user)->toArray();
                $this->assertContains("Hey {$user->name}", $mailData['introLines'][0]);
                $this->assertContains("We just thought we'd let you know that your project {$project->title} on Trackr is at 80% time utilised.", $mailData['introLines'][1]);
                $this->assertEquals('Check Time Logs', $mailData['actionText']);
                $this->assertEquals(route('projects.show', $project), $mailData['actionUrl']);
                $this->assertContains('Thanks for using Trackr!', $mailData['outroLines'][0]);

                // And the notification should be stored in the DB
                $arrayData = $notification->toArray($user);
                $this->assertEquals("Trackr Bot", $arrayData['author']);
                $this->assertEquals("{$project->title} is at 80% time utilised!", $arrayData['title']);
                $this->assertEquals("{$project->title} is at 80% time utilised!", $arrayData['message']);
                $this->assertEquals(route('projects.show', $project), $arrayData['link']);

                return true;
            }
        );
    }

    public function test_a_project_owner_is_notified_once_a_project_hits_one_hundred_percent_time_used()
    {
        Notification::fake();
        // Given we have a Project
        $user = factory(User::class)->create();
        // total seconds is set to 1 HOUR below because of the mutator not being able to be disabled
        // @todo #helpneeded
        $project = factory(Project::class)->create(['user_id' => $user->id, 'total_seconds' => 1]);
        // Which is at 50% time
        $timelog = factory(TimeLog::class)->create([
            'number_of_seconds' => 3600, // 1 hour
            'user_id' => $user->id,
            'project_id' => $project->id
        ]);
        // The project owner should receive a notification
        Notification::assertSentTo($user, ProjectIsAtOneHundredPercentTime::class,
            function ($notification) use ($user, $project) {

                // An email should be sent
                $mailData = $notification->toMail($user)->toArray();
                $this->assertContains("Hey {$user->name}", $mailData['introLines'][0]);
                $this->assertContains("We just thought we'd let you know that your project {$project->title} on Trackr is at 100% time utilised.", $mailData['introLines'][1]);
                $this->assertEquals('Check Time Logs', $mailData['actionText']);
                $this->assertEquals(route('projects.show', $project), $mailData['actionUrl']);
                $this->assertContains('Thanks for using Trackr!', $mailData['outroLines'][0]);

                // And the notification should be stored in the DB
                $arrayData = $notification->toArray($user);
                $this->assertEquals("Trackr Bot", $arrayData['author']);
                $this->assertEquals("{$project->title} is at 100% time utilised!", $arrayData['title']);
                $this->assertEquals("{$project->title} is at 100% time utilised!", $arrayData['message']);
                $this->assertEquals(route('projects.show', $project), $arrayData['link']);

                return true;
            }
        );
    }
}
