<?php
	function draw_calendar($month, $year, $fillSpaces = false, $specials = [], $action = 'none') {
		$calendar = '<table cellpadding="0" cellspacing="0" class="b-calendar__tb">';
		
		// вывод дней недели
		$headings = array('ПН','ВТ','СР','ЧТ','ПТ','СБ','ВС');
		$calendar.= '<tr class="b-calendar__row">';
		for($head_day = 0; $head_day <= 6; $head_day++) {
			$calendar.= '<th class="b-calendar__head';
			// выделяем выходные дни
			if ($head_day != 0) {
				if (($head_day % 5 == 0) || ($head_day % 6 == 0)) {
					$calendar .= ' b-calendar__weekend__name';
				}
			}
			$calendar .= '">';
			$calendar.= '<div class="b-calendar__number">'.$headings[$head_day].'</div>';
			$calendar.= '</th>';
		}
		$calendar.= '</tr>';

		// выставляем начало недели на понедельник
		$running_day = date('w',mktime(0,0,0,$month,1,$year));
		$running_day = $running_day - 1;
		if ($running_day == -1) {
			$running_day = 6;
		}
		
		$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
		$day_counter = 0;
		$days_in_this_week = 1;
		$dates_array = array();
		
		// первая строка календаря
		$calendar.= '<tr class="b-calendar__row">';
		
		// вывод пустых ячеек
		for ($x = 0; $x < $running_day; $x++) {
			if($fillSpaces) {
				$lastMonthDaysCounter = date('t',mktime(0,0,0,$month - 1,1,$year));
				$calendar.= '<td class=b-calendar__np>'.($lastMonthDaysCounter - ($running_day - $x - 1)).'</td>';
			} else {
				$calendar.= '<td class="b-calendar__np"></td>';
				$days_in_this_week++;
			}
		}
		
		// дошли до чисел, будем их писать в первую строку
		for($list_day = 1; $list_day <= $days_in_month; $list_day++) {
			$calendar.= '<td class="b-calendar__day';
			
			if (in_array($list_day, array_keys($specials))) {
				$calendar.= ' specialDay';
			} //Отдельный класс для спец Дней
			// выделяем выходные дни
			if ($running_day != 0) {
				if (($running_day % 5 == 0) || ($running_day % 6 == 0)) {
					$calendar.= ' b-calendar__weekend';
				}
			}
			$calendar .= '">';

			// пишем номер в ячейку
			
			if (in_array($list_day, array_keys($specials))) {
				$calendar.= '<div class="b-calendar__number">';
				$i = 0;
				foreach(array_keys($specials[$list_day]) as $id):
					$i++;
					$calendar.= '<div class="description" data-margin="'.$i.'"><a href="post/'.$id.'">'.$specials[$list_day][$id].'</a></div>';
				endforeach;
				$calendar.= '</div>'.$list_day.'</div>';
			} else {
				$calendar.= '<div class="b-calendar__number">'.$list_day.'</div>';
			}
			$calendar.= '</td>';

			// дошли до последнего дня недели
			if ($running_day == 6) {
				// закрываем строку
				$calendar.= '</tr>';
				// если день не последний в месяце, начинаем следующую строку
				if (($day_counter + 1) != $days_in_month) {
					$calendar.= '<tr class="b-calendar__row">';
				}
				// сбрасываем счетчики 
				$running_day = -1;
				$days_in_this_week = 0;
			}

			$days_in_this_week++; 
			$running_day++; 
			$day_counter++;
		}

		// выводим пустые ячейки в конце последней недели
		if ($days_in_this_week < 8) {
			for($x = 1; $x <= (8 - $days_in_this_week); $x++) {
				if($fillSpaces) {
					$calendar.= '<td class="b-calendar__np">'.$x.'</td>';
				} else {
					$calendar.= '<td class="b-calendar__np"> </td>';
				}
			}
		}
		$calendar.= '</tr>';
		$calendar.= '</table>';

		return $calendar;
	}
?>
<?php
function bootstrapClassesSearch($quantity) {

    static $classes;

    switch($quantity)
    {

        case 5:
        $classes = ['2', '2', '4', '2', '2'];
        break;

        case 7:
        $classes = ['1', '2', '2', '2', '2', '2', '1'];
        break;

        case 8:
        $classes = ['1', '1', '2', '2', '2', '2', '1', '1'];
        break;

        case 9:
        $classes = ['1', '1', '1', '2', '2', '2', '1', '1', '1'];
        break;

        case 10:
        $classes = ['1', '1', '1', '1', '2', '2', '1', '1', '1', '1'];
        break;

        case 11:
        $classes = ['1', '1', '1', '1', '1', '2', '1', '1', '1', '1', '1'];

        default:
        $classes = explode(' ', str_repeat(12/$quantity.' ', $quantity));
        array_pop($classes);
    }
    return $classes;
}
?>
