/**
 * App Calendar Events
 */

'use strict';

let date = new Date();
let nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
let nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
let prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

window.events = [
  {
    id: 1,
    title: 'Design Review',
    start: new Date(),
    end: new Date(new Date().getTime() + 60 * 60 * 1000),
    extendedProps: {
      calendar: 'Business',
      location: 'Conference Room',
      provider: 'John Doe'
    }
  },
  {
    id: 2,
    title: 'Meeting With Client',
    start: new Date(new Date().getTime() + 24 * 60 * 60 * 1000),
    end: new Date(new Date().getTime() + 25 * 60 * 60 * 1000),
    extendedProps: {
      calendar: 'Business',
      location: 'Client Office',
      provider: 'Jane Doe'
    }
  },
  {
    id: 3,
    title: 'Family Trip',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -9),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -7),
    extendedProps: {
      calendar: 'Holiday',
      location: 'Beach',
      provider: 'Family'
    }
  },
  {
    id: 4,
    title: "Doctor's Appointment",
    start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
    extendedProps: {
      calendar: 'Personal',
      location: 'Hospital',
      provider: 'Doctor'
    }
  },
  {
    id: 5,
    title: 'Dart Game?',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    extendedProps: {
      calendar: 'ETC',
      location: 'Game Room',
      provider: 'Friends'
    }
  },
  {
    id: 6,
    title: 'Meditation',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    extendedProps: {
      calendar: 'Personal',
      location: 'Home',
      provider: 'Self'
    }
  },
  {
    id: 7,
    title: 'Dinner',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    extendedProps: {
      calendar: 'Family',
      location: 'Restaurant',
      provider: 'Family'
    }
  },
  {
    id: 8,
    title: 'Product Review',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    extendedProps: {
      calendar: 'Business',
      location: 'Conference Room',
      provider: 'Team'
    }
  },
  {
    id: 9,
    title: 'Monthly Meeting',
    start: nextMonth,
    end: nextMonth,
    extendedProps: {
      calendar: 'Business',
      location: 'Conference Room',
      provider: 'Team'
    }
  },
  {
    id: 10,
    title: 'Monthly Checkup',
    start: prevMonth,
    end: prevMonth,
    extendedProps: {
      calendar: 'Personal',
      location: 'Hospital',
      provider: 'Doctor'
    }
  }
];

// Add event listener for day selection in dropdown
$('.day-dropdown').on('click', 'li', function() {
    $('.day_area').css('display', 'block'); // Show the day_area on day click
});
