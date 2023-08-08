export const leapYear = (dateString) => {
    let dateRegex = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
    let [, day, month, year] = dateString.match(dateRegex);


    day = parseInt(day, 10);
    month = parseInt(month, 10);
    year = parseInt(year, 10);

    // Check leap year
    let isLeapYear = (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);

    // Check day in month
    let daysInMonth = {
        1: 31,
        2: isLeapYear ? 29 : 28,
        3: 31,
        4: 30,
        5: 31,
        6: 30,
        7: 31,
        8: 31,
        9: 30,
        10: 31,
        11: 30,
        12: 31,
    };

    if (month < 1 || month > 12 || day < 1 || day > daysInMonth[month]) {
        return false;
    }

    return true;
}
