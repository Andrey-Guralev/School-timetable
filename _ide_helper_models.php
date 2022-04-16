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
 * @property string|null $alias
 * @property int $shift
 * @property string|null $asc_xml_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Announcements[] $Announcement
 * @property-read int|null $announcement_count
 * @property-read \App\Models\Teacher|null $ClassroomTeacher
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $Groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Load[] $LoadRel
 * @property-read int|null $load_rel_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TelegramSubscribers[] $TelegramSubscriber
 * @property-read int|null $telegram_subscriber_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $Timetable
 * @property-read int|null $timetable_count
 * @method static \Database\Factories\ClassesFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classes whereUpdatedAt($value)
 */
	class Classes extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Group
 *
 * @property int $id
 * @property int $class_id
 * @property string $name
 * @property string|null $asc_xml_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classes|null $Class
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $Timetable
 * @property-read int|null $timetable_count
 * @method static \Database\Factories\GroupFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Group whereUpdatedAt($value)
 */
	class Group extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $name
 * @property string|null $asc_xml_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Load[] $LoadR
 * @property-read int|null $load_r_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Teacher[] $Teacher
 * @property-read int|null $teacher_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Timetable[] $Timetable
 * @property-read int|null $timetable_count
 * @method static \Database\Factories\LessonFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lesson whereUpdatedAt($value)
 */
	class Lesson extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Load
 *
 * @property int $id
 * @property int $lesson_id
 * @property int $class_id
 * @property int $teacher_id
 * @property int $group_id
 * @property string|null $asc_xml_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classes|null $Class
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $Group
 * @property-read int|null $group_count
 * @property-read \App\Models\Lesson|null $Lesson
 * @property-read \App\Models\Teacher|null $Teacher
 * @method static \Database\Factories\LoadFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Load newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Load newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Load query()
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Load whereUpdatedAt($value)
 */
	class Load extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RingSchedule
 *
 * @property int $id
 * @property string|null $start_time
 * @property string|null $end_time
 * @property int|null $number
 * @property int $weekday
 * @property int|null $type
 * @property int $shift
 * @property string|null $asc_xml_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RingSchedule whereWeekday($value)
 */
	class RingSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Room
 *
 * @property int $id
 * @property string $name
 * @property int|null $class_id
 * @property string|null $asc_xml_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\RoomFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Room newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Room query()
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Room whereUpdatedAt($value)
 */
	class Room extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Teacher
 *
 * @property int $id
 * @property int|null $user_id
 * @property array|null $lessons
 * @property int|null $class_id
 * @property string|null $type
 * @property string|null $asc_xml_id
 * @property string|null $asc_teacher_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classes|null $Class
 * @property-read \App\Models\Lesson|null $Lesson
 * @property-read \App\Models\User|null $User
 * @method static \Database\Factories\TeacherFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher query()
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereAscTeacherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereLessons($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Teacher whereUserId($value)
 */
	class Teacher extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TelegramSubscribers
 *
 * @property int $id
 * @property int $chat_id
 * @property int $class_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classes|null $Class
 * @method static \Database\Factories\TelegramSubscribersFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers query()
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TelegramSubscribers whereUpdatedAt($value)
 */
	class TelegramSubscribers extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Timetable
 *
 * @property int $id
 * @property int|null $lesson_id
 * @property int|null $teacher_id
 * @property int|null $class_id
 * @property int|null $load_id
 * @property int|null $group_id
 * @property int $number
 * @property int $weekday
 * @property array $rooms
 * @property string|null $asc_xml_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classes|null $Class
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $Group
 * @property-read int|null $group_count
 * @property-read \App\Models\Lesson|null $Lesson
 * @property-read \App\Models\Load|null $LoadR
 * @property-read \App\Models\User|null $Teacher
 * @method static \Database\Factories\TimetableFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable query()
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereAscXmlId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereLessonId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereLoadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Timetable whereRooms($value)
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
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Announcements[] $Announcements
 * @property-read int|null $announcements_count
 * @property-read \App\Models\Teacher|null $Teacher
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
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

