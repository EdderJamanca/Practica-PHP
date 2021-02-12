$('#calendar').fullCalendar({
	header: {
    	left: 'prev',
    	center: 'title',
    	right: 'next'
  },
  events: [
    {
      start: '2021-01-12',
      end: '2021-01-15',
      rendering: 'background',
      color: '#847059'
    },
    {
      start: '2021-01-22',
      end: '2021-01-24',
      rendering: 'background',
      color: '#FFCC29'
    }
  ]


});

  