function getWeekDay(date) {
	var days = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira',
		'Quinta-Feira', 'Sexta-feira', 'Sábado'];

	return days[date.getDay()];
}

