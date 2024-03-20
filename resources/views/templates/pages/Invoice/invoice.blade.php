<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .flatpickr-calendar {
            position: absolute;
            visibility: hidden;
            overflow: hidden;
            box-sizing: border-box;
            padding: 0;
            max-height: 0;
            border: 0;
            text-align: center;
            opacity: 0;
            -webkit-animation: none;
            animation: none;
            outline: 0;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
        }

        .flatpickr-calendar.open,
        .flatpickr-calendar.inline {
            visibility: visible;
            overflow: visible;
            max-height: 640px;
            opacity: 1;
        }

        .flatpickr-calendar.open {
            display: inline-block;
        }

        .flatpickr-calendar.animate.open {
            -webkit-animation: fpFadeInDown 300ms cubic-bezier(0.23, 1, 0.32, 1);
            animation: fpFadeInDown 300ms cubic-bezier(0.23, 1, 0.32, 1);
        }

        .flatpickr-calendar:not(.inline):not(.open) {
            display: none !important;
        }

        .flatpickr-calendar.inline {
            position: relative;
            top: 2px;
            display: block;
        }

        .flatpickr-calendar.static {
            position: absolute;
            top: calc(100% + 2px);
        }

        .flatpickr-calendar.static.open {
            z-index: 999;
            display: block;
        }

        .flatpickr-calendar.hasWeeks {
            width: auto;
        }

        html:not([dir=rtl]) .flatpickr-calendar.hasWeeks .flatpickr-days {
            border-bottom-left-radius: 0 !important;
        }

        [dir=rtl] .flatpickr-calendar.hasWeeks .flatpickr-days {
            border-bottom-right-radius: 0 !important;
        }

        .flatpickr-calendar.hasTime .flatpickr-time {
            height: 40px;
        }

        .flatpickr-calendar.noCalendar.hasTime .flatpickr-time {
            height: auto;
        }

        .flatpickr-calendar input[type=number] {
            -moz-appearance: textfield;
        }

        .flatpickr-calendar input[type=number]::-webkit-inner-spin-button,
        .flatpickr-calendar input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .flatpickr-wrapper {
            position: relative;
            display: inline-block;
        }

        .flatpickr-month {
            position: relative;
            overflow: hidden;
            height: 3.15rem;
            text-align: center;
            line-height: 1;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .flatpickr-prev-month,
        .flatpickr-next-month {
            position: absolute;
            top: 0.75rem;
            z-index: 3;
            padding: 0 0.41rem;
            height: 1.75rem;
            width: 1.75rem;
            text-decoration: none;
            cursor: pointer;
            border-radius: 50rem;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
        }

        .flatpickr-prev-month svg,
        .flatpickr-next-month svg {
            vertical-align: middle;
        }

        .flatpickr-prev-month i,
        .flatpickr-next-month i {
            position: relative;
        }

        .flatpickr-prev-month.flatpickr-prev-month {
            right: 3.5rem;
        }

        [dir=rtl] .flatpickr-prev-month {
            left: 3.5rem;
            right: auto;
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
        }

        .flatpickr-next-month.flatpickr-prev-month {
            right: 0;
            left: 0;
        }

        .flatpickr-next-month.flatpickr-next-month {
            right: 1rem;
        }

        [dir=rtl] .flatpickr-next-month {
            right: auto;
            left: 1rem;
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
        }

        .flatpickr-prev-month:hover,
        .flatpickr-next-month:hover {
            opacity: 1;
        }

        .flatpickr-prev-month svg,
        .flatpickr-next-month svg {
            width: 0.6rem;
        }

        .flatpickr-prev-month svg path,
        .flatpickr-next-month svg path {
            transition: fill 0.1s;
            fill: inherit;
        }

        .numInputWrapper {
            position: relative;
            height: auto;
        }

        .numInputWrapper input,
        .numInputWrapper span {
            display: inline-block;
        }

        .numInputWrapper input {
            width: 100%;
        }

        .numInputWrapper span {
            position: absolute;
            right: 0;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            box-sizing: border-box;
            width: 14px;
            height: 50%;
            line-height: 1;
            opacity: 0;
            cursor: pointer;
        }

        [dir=rtl] .numInputWrapper span {
            right: auto;
            left: 0;
        }

        .numInputWrapper span:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        .numInputWrapper span:active {
            background: rgba(0, 0, 0, 0.2);
        }

        .numInputWrapper span:after {
            content: "";
            display: block;
            width: 0;
            height: 0;
        }

        .numInputWrapper span.arrowUp {
            top: 0;
        }

        .numInputWrapper span.arrowUp:after {
            border-right: 4px solid transparent;
            border-bottom: 4px solid rgba(72, 72, 72, 0.6);
            border-left: 4px solid transparent;
        }

        .numInputWrapper span.arrowDown {
            top: 50%;
        }

        .numInputWrapper span.arrowDown:after {
            border-top: 4px solid rgba(72, 72, 72, 0.6);
            border-right: 4px solid transparent;
            border-left: 4px solid transparent;
        }

        .numInputWrapper span svg {
            width: inherit;
            height: auto;
        }

        .numInputWrapper span svg path {
            fill: rgba(255, 255, 255, 0.5);
        }

        .numInputWrapper:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .numInputWrapper:hover span {
            opacity: 1;
        }

        .flatpickr-current-month {
            position: absolute;
            left: 1rem;
            top: 1.15rem;
            display: inline-block;
            text-align: left;
            font-weight: 500;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            line-height: 1;
            -webkit-transform: translate3d(0px, 0px, 0px);
            transform: translate3d(0px, 0px, 0px);
        }

        [dir=rtl] .flatpickr-current-month {
            right: 1rem;
            left: auto;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months,
        .flatpickr-current-month input.cur-year {
            padding: 0 0 0 0.5ch;
            outline: none;
            vertical-align: middle !important;
            font-weight: 500;
            font-size: inherit;
            font-family: inherit;
            line-height: inherit;
            color: inherit;
            display: inline-block;
            box-sizing: border-box;
            background: transparent;
            border: 0;
            border-radius: 0;
        }

        .flatpickr-current-month .numInputWrapper {
            display: inline-block;
            width: 6ch;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            -webkit-appearance: menulist;
            -moz-appearance: menulist;
            appearance: menulist;
            cursor: pointer;
            position: relative;
            padding: 0;
        }

        .flatpickr-current-month input.cur-year {
            margin: 0;
            height: 1rem;
            cursor: default;
        }

        [dir=rtl] .flatpickr-current-month input.cur-year {
            padding-right: 0.5ch;
            padding-left: 0;
        }

        .flatpickr-current-month input.cur-year:focus {
            outline: 0;
        }

        .flatpickr-current-month input.cur-year[disabled],
        .flatpickr-current-month input.cur-year[disabled]:hover {
            background: transparent;
            pointer-events: none;
        }

        .flatpickr-current-month input.cur-year[disabled] {
            opacity: 0.5;
        }

        .flatpickr-weekdaycontainer {
            display: -ms-flexbox;
            display: flex;
            width: 100%;
            padding: 1rem 0.875rem 0;
        }

        .flatpickr-weekdays {
            display: -ms-flexbox;
            display: flex;
            overflow: hidden;
            -ms-flex-align: center;
            align-items: center;
            width: 100%;
            height: 1.75rem;
            text-align: center;
        }

        span.flatpickr-weekday {
            display: block;
            -ms-flex: 1;
            flex: 1;
            margin: 0;
            text-align: center;
            line-height: 1;
            cursor: default;
        }

        .dayContainer,
        .flatpickr-weeks {
            padding: 1px 0 0 0;
        }

        .flatpickr-days {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            overflow: hidden;
            width: auto !important;
        }

        .flatpickr-days:focus {
            outline: 0;
        }

        .flatpickr-calendar.hasTime .flatpickr-days {
            border-bottom: 0 !important;
            border-bottom-right-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        .dayContainer {
            display: inline-block;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-pack: distribute;
            justify-content: space-around;
            box-sizing: border-box;
            padding: 0;
            min-width: 14.875rem;
            max-width: 14.875rem;
            width: 14.875rem;
            outline: 0;
            opacity: 1;
            -webkit-transform: translate3d(0px, 0px, 0px);
            transform: translate3d(0px, 0px, 0px);
        }

        .flatpickr-day {
            position: relative;
            display: inline-block;
            -ms-flex-preferred-size: 14.2857143%;
            flex-basis: 14.2857143%;
            -ms-flex-pack: center;
            justify-content: center;
            box-sizing: border-box;
            margin: 0;
            max-width: 2.125rem;
            width: 14.2857143%;
            height: 2.125rem;
            border: 1px solid transparent;
            background: none;
            text-align: center;
            font-weight: 400;
            line-height: calc(2.125rem - 2px);
            cursor: pointer;
        }

        .flatpickr-day.inRange,
        .flatpickr-day.prevMonthDay.inRange,
        .flatpickr-day.nextMonthDay.inRange,
        .flatpickr-day.today.inRange,
        .flatpickr-day.prevMonthDay.today.inRange,
        .flatpickr-day.nextMonthDay.today.inRange,
        .flatpickr-day:hover,
        .flatpickr-day.prevMonthDay:hover,
        .flatpickr-day.nextMonthDay:hover,
        .flatpickr-day:focus,
        .flatpickr-day.prevMonthDay:focus,
        .flatpickr-day.nextMonthDay:focus {
            outline: 0;
            cursor: pointer;
        }

        .flatpickr-day.inRange:not(.startRange):not(.endRange) {
            border-radius: 0 !important;
            border: transparent;
        }

        .flatpickr-day.disabled,
        .flatpickr-day.disabled:hover {
            border-color: transparent;
            background: transparent;
            cursor: default;
            pointer-events: none;
        }

        .flatpickr-day.prevMonthDay,
        .flatpickr-day.nextMonthDay {
            border-color: transparent;
            background: transparent;
            cursor: default;
        }

        .flatpickr-day.notAllowed,
        .flatpickr-day.notAllowed.prevMonthDay,
        .flatpickr-day.notAllowed.nextMonthDay {
            border-color: transparent;
            background: transparent;
            cursor: default;
        }

        .flatpickr-day.week.selected {
            border-radius: 0;
        }

        html:not([dir=rtl]) .flatpickr-day.selected.startRange,
        html:not([dir=rtl]) .flatpickr-day.startRange.startRange,
        html:not([dir=rtl]) .flatpickr-day.endRange.startRange {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        html:not([dir=rtl]) .flatpickr-day.selected.endRange,
        html:not([dir=rtl]) .flatpickr-day.startRange.endRange,
        html:not([dir=rtl]) .flatpickr-day.endRange.endRange {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        [dir=rtl] .flatpickr-day.selected.startRange,
        [dir=rtl] .flatpickr-day.startRange.startRange,
        [dir=rtl] .flatpickr-day.endRange.startRange {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        [dir=rtl] .flatpickr-day.selected.endRange,
        [dir=rtl] .flatpickr-day.startRange.endRange,
        [dir=rtl] .flatpickr-day.endRange.endRange {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .flatpickr-weekwrapper {
            display: inline-block;
            float: left;
        }

        .flatpickr-weekwrapper .flatpickr-weeks {
            padding: 0.75rem 0;
            background-clip: padding-box !important;
        }

        html:not([dir=rtl]) .flatpickr-weekwrapper .flatpickr-weeks .flatpickr-weeks {
            border-bottom-right-radius: 0 !important;
        }

        [dir=rtl] .flatpickr-weekwrapper .flatpickr-weeks .flatpickr-weeks {
            border-bottom-left-radius: 0 !important;
        }

        .flatpickr-weekwrapper .flatpickr-calendar.hasTime .flatpickr-weeks {
            border-bottom: 0 !important;
            border-bottom-right-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        .flatpickr-weekwrapper .flatpickr-weekday {
            float: none;
            width: 100%;
            line-height: 1.75rem;
            position: relative;
            top: 0.5652rem;
        }

        .flatpickr-weekwrapper span.flatpickr-day {
            display: block;
            max-width: none;
            width: 2.125rem;
            background: none !important;
        }

        .flatpickr-calendar.hasTime .flatpickr-weeks {
            border-bottom: 0 !important;
            border-bottom-left-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        .flatpickr-innerContainer {
            display: block;
            display: -ms-flexbox;
            display: flex;
            overflow: hidden;
            box-sizing: border-box;
        }

        .flatpickr-rContainer {
            display: inline-block;
            box-sizing: border-box;
            padding: 0;
        }

        .flatpickr-time {
            display: block;
            display: -ms-flexbox;
            display: flex;
            overflow: hidden;
            box-sizing: border-box;
            max-height: 40px;
            height: 0;
            outline: 0;
            background-clip: padding-box !important;
            text-align: center;
            line-height: 40px;
        }

        .flatpickr-time:after {
            content: "";
            display: table;
            clear: both;
        }

        .flatpickr-time .numInputWrapper {
            float: left;
            -ms-flex: 1;
            flex: 1;
            width: 40%;
            height: 40px;
        }

        .flatpickr-time.hasSeconds .numInputWrapper {
            width: 26%;
        }

        .flatpickr-time.time24hr .numInputWrapper {
            width: 49%;
        }

        .flatpickr-time input {
            position: relative;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            height: inherit;
            border: 0;
            border-radius: 0;
            background: transparent;
            box-shadow: none;
            text-align: center;
            line-height: inherit;
            cursor: pointer;
        }

        .flatpickr-time input.flatpickr-minute,
        .flatpickr-time input.flatpickr-second {
            font-weight: normal;
        }

        .flatpickr-time input:focus {
            outline: 0;
            border: 0;
        }

        .flatpickr-time .flatpickr-time-separator,
        .flatpickr-time .flatpickr-am-pm {
            display: inline-block;
            float: left;
            -ms-flex-item-align: center;
            align-self: center;
            width: 2%;
            height: inherit;
            line-height: inherit;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .flatpickr-time .flatpickr-am-pm {
            width: 18%;
            outline: 0;
            text-align: center;
            font-weight: normal;
            cursor: pointer;
        }

        .flatpickr-time .flatpickr-am-pm:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .flatpickr-calendar.noCalendar .flatpickr-time {
            box-shadow: none !important;
        }

        .flatpickr-calendar:not(.noCalendar) .flatpickr-time {
            border-top: 0;
            border-top-left-radius: 0 !important;
            border-top-right-radius: 0 !important;
        }

        .flatpickr-input[readonly] {
            cursor: pointer;
        }

        @-webkit-keyframes fpFadeInDown {
            from {
                opacity: 0;
                -webkit-transform: translate3d(0, -20px, 0);
                transform: translate3d(0, -20px, 0);
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
        }

        @keyframes fpFadeInDown {
            from {
                opacity: 0;
                -webkit-transform: translate3d(0, -20px, 0);
                transform: translate3d(0, -20px, 0);
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
        }

        .light-style .flatpickr-calendar {
            background: #fff;
        }

        .light-style .flatpickr-prev-month,
        .light-style .flatpickr-next-month {
            background-color: #f1f0f2;
        }

        .light-style .flatpickr-prev-month svg,
        .light-style .flatpickr-next-month svg {
            fill: #6f6b7d;
            stroke: #6f6b7d;
        }

        .light-style .flatpickr-calendar,
        .light-style .flatpickr-days {
            width: calc(16.625rem + 0px) !important;
        }

        .light-style .flatpickr-calendar.hasWeeks {
            width: calc(18.75rem + 0px) !important;
        }

        .light-style .flatpickr-calendar.open {
            z-index: 1091;
        }

        .light-style .flatpickr-input[readonly],
        .light-style .flatpickr-input~.form-control[readonly] {
            background: #fff;
        }

        .light-style .flatpickr-days {
            background: #fff;
            padding: 0.75rem 0.875rem;
            border: 0px solid #dbdade;
            border-top: 0;
            background-clip: padding-box;
            border-bottom-right-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
        }

        .light-style:not([dir=rtl]) .flatpickr-calendar.hasWeeks .flatpickr-days {
            border-left: 0;
            padding-left: calc(0.875rem + 0px);
            box-shadow: 0px 0 0 #dbdade inset;
        }

        .light-style[dir=rtl] .flatpickr-calendar.hasWeeks .flatpickr-days {
            border-right: 0;
            padding-right: calc(0.875rem + 0px);
            box-shadow: 0px 0 0 #dbdade inset;
        }

        .light-style .flatpickr-calendar {
            line-height: 1.47;
            box-shadow: 0 0.25rem 1rem rgba(165, 163, 174, 0.45);
            border-radius: 0.375rem;
        }

        .light-style .flatpickr-calendar.hasTime:not(.noCalendar):not(.hasTime) .flatpickr-time {
            display: none !important;
        }

        .light-style .flatpickr-calendar.hasTime .flatpickr-time {
            box-shadow: 0 1px 0 #dbdade inset;
        }

        .light-style .flatpickr-month {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            border-bottom: 1px solid #dbdade;
        }

        .light-style .flatpickr-month option.flatpickr-monthDropdown-month {
            color: #6f6b7d;
            background: #fff;
        }

        .light-style span.flatpickr-weekday {
            font-weight: 500;
            font-size: 0.8125rem;
            background: #fff;
            color: #5d596c;
        }

        .light-style .flatpickr-day {
            color: #6f6b7d;
            border-radius: 50rem;
        }

        .light-style .flatpickr-day:hover,
        .light-style .flatpickr-day:focus,
        .light-style .flatpickr-day.prevMonthDay:hover,
        .light-style .flatpickr-day.nextMonthDay:hover,
        .light-style .flatpickr-day.today:hover,
        .light-style .flatpickr-day.prevMonthDay:focus,
        .light-style .flatpickr-day.nextMonthDay:focus,
        .light-style .flatpickr-day.today:focus {
            background: #f1f0f2;
        }

        .light-style .flatpickr-day:hover:not(.today),
        .light-style .flatpickr-day:focus:not(.today),
        .light-style .flatpickr-day.prevMonthDay:hover:not(.today),
        .light-style .flatpickr-day.nextMonthDay:hover:not(.today),
        .light-style .flatpickr-day.today:hover:not(.today),
        .light-style .flatpickr-day.prevMonthDay:focus:not(.today),
        .light-style .flatpickr-day.nextMonthDay:focus:not(.today),
        .light-style .flatpickr-day.today:focus:not(.today) {
            border-color: transparent;
        }

        .light-style .flatpickr-day.prevMonthDay,
        .light-style .flatpickr-day.nextMonthDay,
        .light-style .flatpickr-day.flatpickr-disabled {
            color: #a5a3ae;
        }

        .light-style .flatpickr-day.prevMonthDay.today,
        .light-style .flatpickr-day.nextMonthDay.today,
        .light-style .flatpickr-day.flatpickr-disabled.today {
            border: none;
        }

        .light-style .flatpickr-day.disabled {
            color: #b7b5be !important;
        }

        .light-style .flatpickr-day.selected.startRange.endRange {
            border-radius: 0.375rem !important;
        }

        .light-style .flatpickr-day.selected {
            box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
        }

        .light-style .flatpickr-weeks {
            border-bottom: 0px solid #dbdade;
            border-left: 0px solid #dbdade;
            background: #fff;
            border-bottom-right-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0;
        }

        .light-style[dir=rtl] .flatpickr-weeks {
            border-right: 0px solid #dbdade;
            border-left: 0;
            border-bottom-right-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
            border-bottom-left-radius: 0;
        }

        .light-style .flatpickr-time {
            border: 0px solid #dbdade;
            background: #fff;
            border-radius: 0.375rem;
        }

        .light-style .flatpickr-time input {
            color: #6f6b7d;
            font-size: 0.9375rem;
        }

        .light-style .flatpickr-time input.flatpickr-hour {
            font-weight: 500;
        }

        .light-style .flatpickr-time input.flatpickr-minute,
        .light-style .flatpickr-time input.flatpickr-second {
            font-weight: 500;
        }

        .light-style .flatpickr-time .numInputWrapper span.arrowUp:after {
            border-bottom-color: #a5a3ae;
        }

        .light-style .flatpickr-time .numInputWrapper span.arrowDown:after {
            border-top-color: #a5a3ae;
        }

        .light-style .flatpickr-time .flatpickr-am-pm {
            color: #6f6b7d;
        }

        .light-style .flatpickr-time .flatpickr-time-separator {
            color: #6f6b7d;
            font-weight: 500;
        }

        .dark-style .flatpickr-calendar {
            background: #2f3349;
        }

        .dark-style .flatpickr-prev-month,
        .dark-style .flatpickr-next-month {
            background-color: #363b54;
        }

        .dark-style .flatpickr-prev-month svg,
        .dark-style .flatpickr-next-month svg {
            fill: #b6bee3;
            stroke: #b6bee3;
        }

        .dark-style .flatpickr-calendar,
        .dark-style .flatpickr-days {
            width: calc(16.625rem + 0px) !important;
        }

        .dark-style .flatpickr-calendar.hasWeeks,
        .dark-style .flatpickr-calendar.hasWeeks .flatpickr-days {
            width: calc(18.75rem + 0px) !important;
        }

        .dark-style .flatpickr-calendar.open {
            z-index: 1091;
        }

        .dark-style .flatpickr-input:not(.is-invalid):not(.is-valid)~.form-control:disabled,
        .dark-style .flatpickr-input:not(.is-invalid):not(.is-valid)[readonly],
        .dark-style .flatpickr-input:not(.is-invalid):not(.is-valid)~.form-control[readonly] {
            background-color: #2f3349;
        }

        .dark-style .flatpickr-days {
            border: 0px solid #434968;
            border-top: 0;
            padding: 0.75rem 0.875rem;
            background: #2f3349;
            background-clip: padding-box;
            border-bottom-right-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
        }

        .dark-style:not([dir=rtl]) .flatpickr-calendar.hasWeeks .flatpickr-days {
            border-left: 0;
            padding-left: calc(0.875rem + 0px);
            box-shadow: 0px 0 0 #434968 inset;
        }

        .dark-style[dir=rtl] .flatpickr-calendar.hasWeeks .flatpickr-days {
            border-right: 0;
            padding-right: calc(0.875rem + 0px);
            box-shadow: 0px 0 0 #434968 inset;
        }

        .dark-style .flatpickr-calendar {
            line-height: 1.47;
            box-shadow: 0 0.25rem 1rem rgba(15, 20, 34, 0.55);
            border-radius: 0.375rem;
        }

        .dark-style .flatpickr-calendar.hasTime:not(.noCalendar):not(.hasTime) .flatpickr-time {
            display: none !important;
        }

        .dark-style .flatpickr-calendar.hasTime .flatpickr-time {
            box-shadow: 0 1px 0 #434968 inset;
        }

        .dark-style .flatpickr-month {
            border-top-left-radius: 0.375rem;
            border-top-right-radius: 0.375rem;
            border-bottom: 1px solid #434968;
        }

        .dark-style .flatpickr-month option.flatpickr-monthDropdown-month {
            color: #b6bee3;
            background: #2f3349;
        }

        .dark-style span.flatpickr-weekday {
            font-weight: 500;
            font-size: 0.8125rem;
            background: #2f3349;
            color: #cfd3ec;
        }

        .dark-style .flatpickr-day {
            color: #b6bee3;
            font-weight: 500;
            border-radius: 50rem;
        }

        .dark-style .flatpickr-day:hover,
        .dark-style .flatpickr-day:focus,
        .dark-style .flatpickr-day.nextMonthDay:hover,
        .dark-style .flatpickr-day.prevMonthDay:hover,
        .dark-style .flatpickr-day.today:hover,
        .dark-style .flatpickr-day.nextMonthDay:focus,
        .dark-style .flatpickr-day.prevMonthDay:focus,
        .dark-style .flatpickr-day.today:focus {
            border-color: transparent;
            background: #363b54;
        }

        .dark-style .flatpickr-day.nextMonthDay,
        .dark-style .flatpickr-day.prevMonthDay,
        .dark-style .flatpickr-day.flatpickr-disabled {
            color: #7983bb;
        }

        .dark-style .flatpickr-day.nextMonthDay.today,
        .dark-style .flatpickr-day.prevMonthDay.today,
        .dark-style .flatpickr-day.flatpickr-disabled.today {
            border: 0;
        }

        .dark-style .flatpickr-day.selected.startRange.endRange {
            border-radius: 0.375rem !important;
        }

        .dark-style .flatpickr-day.disabled {
            color: #354288 !important;
        }

        .dark-style .flatpickr-day.selected {
            box-shadow: 0 0.125rem 0.25rem rgba(15, 20, 34, 0.4);
        }

        .dark-style .flatpickr-weeks {
            border-bottom: 0px solid #434968;
            border-left: 0px solid #434968;
            background: #2f3349;
            border-bottom-right-radius: 0.375rem;
            border-bottom-left-radius: 0.375rem;
            border-bottom-right-radius: 0;
        }

        .dark-style[dir=rtl] .flatpickr-weeks {
            border-right: 0px solid #434968;
            border-left: 0;
        }

        .dark-style .flatpickr-time {
            border: 0px solid #434968;
            background: #2f3349;
            border-radius: 0.375rem;
        }

        .dark-style .flatpickr-time input {
            color: #b6bee3;
        }

        .dark-style .flatpickr-time input.flatpickr-hour {
            font-weight: 500;
        }

        .dark-style .flatpickr-time input.flatpickr-minute,
        .dark-style .flatpickr-time input.flatpickr-second {
            font-weight: 500;
        }

        .dark-style .flatpickr-time .numInputWrapper span.arrowUp:after {
            border-bottom-color: #7983bb;
        }

        .dark-style .flatpickr-time .numInputWrapper span.arrowDown:after {
            border-top-color: #7983bb;
        }

        .dark-style .flatpickr-time .flatpickr-am-pm {
            color: #b6bee3;
        }

        .dark-style .flatpickr-time .flatpickr-time-separator {
            color: #b6bee3;
            font-weight: 500;
        }
    </style>
</head>

<body>


    <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
            <div class="card-body">
                <div
                    class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                    <div class="mb-xl-0 mb-4">
                        <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                            <svg width="32" height="20" viewBox="0 0 32 22" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#7367F0"></path>
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                    fill="#161616">
                                </path>
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                    fill="#161616">
                                </path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#7367F0"></path>
                            </svg>
                            <span class="app-brand-text fw-bold fs-4">
                                MapGame
                            </span>
                        </div>
                        <p class="mb-2">Office 149, 450 South Brand Brooklyn</p>
                        <p class="mb-2">San Diego County, CA 91905, USA</p>
                        <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                    </div>
                    <div>
                        <h4 class="fw-medium mb-2">INVOICE #86423</h4>
                        <div class="mb-2 pt-1">
                            <span>Date Issues:</span>
                            <span class="fw-medium">April 25, 2021</span>
                        </div>
                        <div class="pt-1">
                            <span>Date Due:</span>
                            <span class="fw-medium">May 25, 2021</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <div class="row p-sm-3 p-0">
                    <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                        <h6 class="mb-3">Invoice To:</h6>
                        <p class="mb-1">Thomas shelby</p>
                        <p class="mb-1">Shelby Company Limited</p>
                        <p class="mb-1">Small Heath, B10 0HF, UK</p>
                        <p class="mb-1">718-986-6062</p>
                        <p class="mb-0">peakyFBlinders@gmail.com</p>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                        <h6 class="mb-4">Bill To:</h6>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="pe-4">Total Due:</td>
                                    <td class="fw-medium">$12,110.55</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">Bank name:</td>
                                    <td>American Bank</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">Country:</td>
                                    <td>United States</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">IBAN:</td>
                                    <td>ETD95476213874685</td>
                                </tr>
                                <tr>
                                    <td class="pe-4">SWIFT code:</td>
                                    <td>BR91905</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="table-responsive border-top">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Description</th>
                            <th>Cost</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-nowrap">Vuexy Admin Template</td>
                            <td class="text-nowrap">HTML Admin Template</td>
                            <td>$32</td>
                            <td>1</td>
                            <td>$32.00</td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">Frest Admin Template</td>
                            <td class="text-nowrap">Angular Admin Template</td>
                            <td>$22</td>
                            <td>1</td>
                            <td>$22.00</td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">Apex Admin Template</td>
                            <td class="text-nowrap">HTML Admin Template</td>
                            <td>$17</td>
                            <td>2</td>
                            <td>$34.00</td>
                        </tr>
                        <tr>
                            <td class="text-nowrap">Robust Admin Template</td>
                            <td class="text-nowrap">React Admin Template</td>
                            <td>$66</td>
                            <td>1</td>
                            <td>$66.00</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="align-top px-4 py-4">
                                <p class="mb-2 mt-3">
                                    <span class="ms-3 fw-medium">Salesperson:</span>
                                    <span>Alfie Solomons</span>
                                </p>
                                <span class="ms-3">Thanks for your business</span>
                            </td>
                            <td class="text-end pe-3 py-4">
                                <p class="mb-2 pt-3">Subtotal:</p>
                                <p class="mb-2">Discount:</p>
                                <p class="mb-2">Tax:</p>
                                <p class="mb-0 pb-3">Total:</p>
                            </td>
                            <td class="ps-2 py-4">
                                <p class="fw-medium mb-2 pt-3">$154.25</p>
                                <p class="fw-medium mb-2">$00.00</p>
                                <p class="fw-medium mb-2">$50.00</p>
                                <p class="fw-medium mb-0 pb-3">$204.25</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-body mx-3">
                <div class="row">
                    <div class="col-12">
                        <span class="fw-medium">Note:</span>
                        <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                            future
                            freelance
                            projects. Thank You!</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
