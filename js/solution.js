function under_five(num_list) {
    var answer = num_list.sort(function (a, b) {
        return a - b
    }).slice(0, 5);
    return answer;
}

function dice(a, b) {
    if ((a + b) % 2 == 0) {
        if (a % 2 == 0 & b % 2 == 0) {
            return Math.abs(a - b)
        } else {
            return (a ** 2) + (b ** 2)
        }
    } else {
        return 2 * (a + b);
    }
}

function flo(flo) {
    var answer = Math.floor(flo);
    return answer;
}

function string_to_message(my_string, index_list) {
    var answer_array = [];
    for (let idx of index_list) {
        answer_array.push(my_string[idx]);
    }
    var answer = answer_array.join('');
    return answer;
}

function find(num_list, n) {
    if (num_list.find(num => num == n) == undefined) {
        return 0;
    } else {
        return 1;
    };
}

function at(num_list) {
    var answer = num_list;
    if (num_list.at(-1) > num_list.at(-2)) {
        answer.push(num_list.at(-1) - num_list.at(-2))
    } else {
        answer.push(num_list.at(-1) * 2)
    }
    return answer;
}

function cnt(start_num, end_num) {
    var answer = [];
    for (let i = start_num; i < end_num + 1; i++) {
        answer.push(i)
    }
    return answer;
}

function solution(number, n, m) {
    return number % n === 0 && number % m === 0 ? 1 : 0
}

