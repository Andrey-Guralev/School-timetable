function addForms(e) {

    let tr = e.target.parentNode;
    let tableRows = tr.parentNode.parentNode.rows;
    let prevTr = tableRows[tableRows.length - 2]

    if (tableRows.length === 1)
    {
        let i = tr.parentNode;

        i.insertAdjacentHTML('beforebegin', `
         <tr class="bg-white">
             <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                 <div class="lesson flex items-center">1. &nbsp; <input type="text" name="lesson-${weekday}-1"  data-type="lesson" data-weekday="${weekday}" data-number="1" class="shadow-sm focus:ring-indigo-500 focus:border indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></div>
                 <div class="rooms flex">
                     <input type="text" name="room1-${weekday}-1" value="" data-type="room1"  data-weekday="${weekday}" data-number="1" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-16 sm:text-sm border-gray-300 rounded-md">
                     <input type="text" name="room2-${weekday}-1" value="" data-type="room2"  data-weekday="${weekday}" data-number="1" class="ml-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-16 sm:text-sm border-gray-300 rounded-md"></div>
             </td>
         </tr>
    `);

        return
    }

    let number = Number(prevTr.childNodes[1].childNodes[1].childNodes[0].nodeValue.substr(0, 2)) + 1;
    let lessonInput = prevTr.childNodes[1].childNodes[1].childNodes[1];
    let weekday = lessonInput.dataset.weekday;

    prevTr.insertAdjacentHTML('afterend', `
             <tr class="bg-white">
                 <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex justify-between">
                     <div class="lesson flex items-center">${number}. &nbsp; <input type="text" name="lesson-${weekday}-${number}"  data-type="lesson" data-weekday="${weekday}" data-number="${number}" class="shadow-sm focus:ring-indigo-500 focus:border indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></div>
                     <div class="rooms flex">
                         <input type="text" name="room1-${weekday}-${number}" value="" data-type="room1"  data-weekday="${weekday}" data-number="${number}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-16 sm:text-sm border-gray-300 rounded-md">
                         <input type="text" name="room2-${weekday}-${number}" value="" data-type="room2"  data-weekday="${weekday}" data-number="${number}" class="ml-4 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-16 sm:text-sm border-gray-300 rounded-md"></div>
                 </td>
             </tr>
        `);

}

function deleteForms(e) {
    e.preventDefault();
    let tr = e.target.parentNode;
    let tableRows = tr.parentNode.parentNode.rows;
    let prevTr = tableRows[tableRows.length - 2]

    prevTr.remove();
}

function init() {
    let buttons = [];

    for (let i = 0; i <= 5; i++) {
        buttons[i] = document.getElementById('btn-' + i);
        buttons[i].addEventListener('click', addForms)
    }

    const deleteButtons = document.querySelectorAll('.delete');
    deleteButtons.forEach(function (element, i, arr) {
        element.addEventListener('click', deleteForms);
    });
}

init();
