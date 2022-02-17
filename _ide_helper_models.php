<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Announcements
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property int $type
 * @property int $author_id
 * @property int|null $class_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $Author
 * @property-read \App\Models\Classes|null $Classes
 * @method static \Database\Factories\AnnouncementsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements query()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcements whereUpdatedAt($value)
 */
	class Announcements extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classes
 *
 * @property int $id
 * @property int $number
 * @property string $letter
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Announcements[] $Announcement
 * @property-read int|null $announcement_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Students[] $Students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $Timetable
 * @property-read int|null $timetable_count
 * @method static \Database\Factories\ClassesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereUpdatedAt($value)
 */
	class Classes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RingSchedule
 *
 * @method static \Database\Factories\RingScheduleFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule query()
 */
	class RingSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Students
 *
 * @property-read \App\Models\User|null $User
 * @method static \Database\Factories\StudentsFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Students newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Students newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Students query()
 */
	class Students extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Teachers
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $Timetable
 * @property-read int|null $timetable_count
 * @property-read \App\Models\User|null $User
 * @method static \Database\Factories\TeachersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Teachers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teachers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teachers query()
 */
	class Teachers extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Timetable
 *
 * @property int $id
 * @property string $lesson
 * @property int|null $teacher_id
 * @property int $class_id
 * @property int $number
 * @property int $weekday
 * @property string|null $room_1
 * @property string|null $room_2
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $Teacher
 * @method static \Database\Factories\TimetableFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereLesson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereRoom1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereRoom2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereWeekday($value)
 */
	class Timetable extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string|null $first_name
 * @property string|null $second_name
 * @property string|null $middle_name
 * @property int $type
 * @property int|null $class_id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Announcements[] $Announcements
 * @property-read int|null $announcements_count
 * @property-read \App\Models\Classes|null $Class
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSecondName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

