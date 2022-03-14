<?php

namespace App\Actions;

use App\Models\RingSchedule;

class RingScheduleHandler
{
    public function handle($data)
    {
        unset($data['_token']);

        $types = [
            'fir_monday' => 0,
            'fir_regular_day' => 1,
            'fir_sunday' => 2,
            'sec_monday' => 3,
            'sec_regular_day' => 4,
            'sec_sunday' => 5,
            'sec_class_hour' => 6
        ];

        foreach ($data as $key => $value)
        {
            if (\Str::contains($key, 'fir'))
            {
                if (\Str::contains($key, 'monday'))
                {
                    if (\Str::contains($key, 'start'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['fir_monday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->start_time = $value;
                        $ring->type = $types['fir_monday'];
                        $ring->shift = 0;

                        $ring->save();
                    }
                    if (\Str::contains($key, 'end'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['fir_monday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->end_time = $value;
                        $ring->type = $types['fir_monday'];
                        $ring->shift = 0;

                        $ring->save();
                    }
                }

                if (\Str::contains($key, 'regular'))
                {
                    if (\Str::contains($key, 'start'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['fir_regular_day'])->firstOrNew();

                        $ring->number = $number;
                        $ring->start_time = $value;
                        $ring->type = $types['fir_regular_day'];
                        $ring->shift = 0;

                        $ring->save();
                    }
                    if (\Str::contains($key, 'end'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['fir_regular_day'])->firstOrNew();

                        $ring->number = $number;
                        $ring->end_time = $value;
                        $ring->type = $types['fir_regular_day'];
                        $ring->shift = 0;

                        $ring->save();
                    }
                }

                if (\Str::contains($key, 'sunday'))
                {
                    if (\Str::contains($key, 'start'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['fir_sunday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->start_time = $value;
                        $ring->type = $types['fir_sunday'];
                        $ring->shift = 0;

                        $ring->save();
                    }
                    if (\Str::contains($key, 'end'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['fir_sunday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->end_time = $value;
                        $ring->type = $types['fir_sunday'];
                        $ring->shift = 0;

                        $ring->save();
                    }
                }
            }
            if (\Str::contains($key, 'sec'))
            {
                if (\Str::contains($key, 'monday'))
                {
                    if (\Str::contains($key, 'start'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_monday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->start_time = $value;
                        $ring->type = $types['sec_monday'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                    if (\Str::contains($key, 'end'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_monday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->end_time = $value;
                        $ring->type = $types['sec_monday'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                }

                if (\Str::contains($key, 'class_hour'))
                {
                    if (\Str::contains($key, 'start'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_class_hour'])->firstOrNew();

                        $ring->number = $number;
                        $ring->start_time = $value;
                        $ring->type = $types['sec_class_hour'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                    if (\Str::contains($key, 'end'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_class_hour'])->firstOrNew();

                        $ring->number = $number;
                        $ring->end_time = $value;
                        $ring->type = $types['sec_class_hour'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                }

                if (\Str::contains($key, 'regular'))
                {
                    if (\Str::contains($key, 'start'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_regular_day'])->firstOrNew();

                        $ring->number = $number;
                        $ring->start_time = $value;
                        $ring->type = $types['sec_regular_day'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                    if (\Str::contains($key, 'end'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_regular_day'])->firstOrNew();

                        $ring->number = $number;
                        $ring->end_time = $value;
                        $ring->type = $types['sec_regular_day'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                }

                if (\Str::contains($key, 'sunday'))
                {
                    if (\Str::contains($key, 'start'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_sunday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->start_time = $value;
                        $ring->type = $types['sec_sunday'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                    if (\Str::contains($key, 'end'))
                    {
                        $number = \Str::substr($key, -1, 1);

                        $ring = RingSchedule::where('number', $number)->where('type', $types['sec_sunday'])->firstOrNew();

                        $ring->number = $number;
                        $ring->end_time = $value;
                        $ring->type = $types['sec_sunday'];
                        $ring->shift = 1;

                        $ring->save();
                    }
                }
            }
        }
    }
}
