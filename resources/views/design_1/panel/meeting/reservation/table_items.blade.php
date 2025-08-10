<tr>
    <td class="text-left">
        <div class="user-inline-avatar d-flex align-items-center">
            <div class="size-48 bg-gray-200 rounded-circle">
                <img src="{{ $reserveMeeting->meeting->creator->getAvatar() }}" class="js-avatar-img img-cover rounded-circle" alt="">
            </div>
            <div class=" ml-8">
                <span class="d-block =">{{ $reserveMeeting->meeting->creator->full_name }}</span>
                <span class="mt-4 font-12 text-gray-500 d-block">{{ $reserveMeeting->meeting->creator->email }}</span>
            </div>
        </div>
    </td>

    <td class="text-center">
        <span class="=">{{ trans('update.'.$reserveMeeting->meeting_type) }}</span>
    </td>

    <td class="text-center">
        <span class="=">{{ dateTimeFormat($reserveMeeting->start_at, 'D') }}</span>
    </td>

    <td class="text-center">
        <span>{{ dateTimeFormat($reserveMeeting->start_at, 'j M Y') }}</span>
    </td>

    <td class="text-center">
        <div class="d-inline-flex align-items-center rounded bg-gray-200 py-4 px-8 font-14 rounded-8">
            <span class="">{{ dateTimeFormat($reserveMeeting->start_at, 'H:i') }}</span>
            <span class="mx-1">-</span>
            <span class="">{{ dateTimeFormat($reserveMeeting->end_at, 'H:i') }}</span>
        </div>
    </td>

    <td class="text-center =">
        @if(!empty($reserveMeeting->sale) and !empty($reserveMeeting->sale->total_amount) and $reserveMeeting->sale->total_amount > 0)
            {{ handlePrice($reserveMeeting->sale->total_amount) }}

        @else
            {{ trans('public.free') }}
        @endif
    </td>

    <td class="text-center =">
        {{ $reserveMeeting->student_count ?? 1 }}
    </td>

    <td class="text-center">
        @switch($reserveMeeting->status)
            @case(\App\Models\ReserveMeeting::$pending)
                <span class="text-warning =">{{ trans('public.pending') }}</span>
                @break
            @case(\App\Models\ReserveMeeting::$open)
                <span class="text-gray-500 =">{{ trans('public.open') }}</span>
                @break
            @case(\App\Models\ReserveMeeting::$finished)
                <span class="= text-primary">{{ trans('public.finished') }}</span>
                @break
            @case(\App\Models\ReserveMeeting::$canceled)
                <span class="text-danger =">{{ trans('public.canceled') }}</span>
                @break
        @endswitch
    </td>

    <td class="text-right">
        @if(!in_array($reserveMeeting->status, [\App\Models\ReserveMeeting::$finished, \App\Models\ReserveMeeting::$canceled]))
            <input type="hidden" class="js-meeting-password-{{ $reserveMeeting->id }}" value="{{ $reserveMeeting->password }}">
            <input type="hidden" class="js-meeting-link-{{ $reserveMeeting->id }}" value="{{ $reserveMeeting->link }}">


            <div class="actions-dropdown position-relative d-flex justify-content-end align-items-center">
                <button type="button" class="d-flex-center size-36 bg-gray border-gray-200 rounded-10">
                    <x-iconsax-lin-more class="icons text-gray-500" width="18"/>
                </button>

                <div class="actions-dropdown__dropdown-menu dropdown-menu-width-220 dropdown-menu-top-32">
                    <ul class="my-8">

                        @if($reserveMeeting->meeting_type != 'in_person' and $reserveMeeting->status == \App\Models\ReserveMeeting::$open and (!empty($reserveMeeting->link) or !empty($reserveMeeting->session)))
                            <li class="actions-dropdown__dropdown-menu-item">
                                <button type="button" data-path="/panel/meetings/{{ $reserveMeeting->id }}/join-modal" class="js-join-to-session ">{{ trans('footer.join') }}</button>
                            </li>
                        @endif

                        <li class="actions-dropdown__dropdown-menu-item">
                            <a href="{{ $reserveMeeting->addToCalendarLink() }}" target="_blank"
                               class="">{{ trans('public.add_to_calendar') }}</a>
                        </li>

                        <li class="actions-dropdown__dropdown-menu-item">
                            <button type="button"
                                    data-path="/panel/meetings/{{ $reserveMeeting->id }}/contact-info" data-title="{{ trans('panel.student_contact_information') }}"
                                    class="js-meeting-contact-info ">{{ trans('panel.contact_instructor') }}</button>
                        </li>

                        <li class="actions-dropdown__dropdown-menu-item">
                            <button type="button" class="js-finish-meeting-reserve " data-path="/panel/meetings/{{ $reserveMeeting->id }}/get-finish-modal" data-title="{{ trans('panel.finish_meeting') }}">{{ trans('panel.finish_meeting') }}</button>
                        </li>

                    </ul>
                </div>
            </div>
        @endif
    </td>

</tr>

