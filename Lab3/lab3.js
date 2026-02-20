let students = [];
let nextId = 1;
let lastAddedId = null;

fetch('students.json')
    .then(res => res.json())
    .then(data => {
        students = data;
        nextId = students.length > 0 ? Math.max(...students.map(s => s.id)) + 1 : 1;
        updateTable();
    });

function updateTable() {
    const search = document.getElementById('search').value.toLowerCase();
    const sort = document.getElementById('sortSelect').value;
    
    let filtered = students.filter(s => s.name.toLowerCase().includes(search));
    
    if (sort === 'name') filtered.sort((a, b) => a.name.localeCompare(b.name));
    if (sort === 'age') filtered.sort((a, b) => a.age - b.age);
    
    const tbody = document.getElementById('studentTableBody');
    tbody.innerHTML = filtered.length ? filtered.map(s => 
        `<tr${s.id === lastAddedId ? ' class="newly-added"' : ''}><td>${s.id}</td><td>${s.name}</td><td>${s.age}</td><td>${s.course}</td></tr>`
    ).join('') : '<tr><td colspan="4">No students found</td></tr>';
}

document.getElementById('search').addEventListener('input', updateTable);

document.getElementById('sortSelect').addEventListener('change', updateTable);

document.getElementById('addStudentForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const name = document.getElementById('studentName').value.trim();
    const age = document.getElementById('studentAge').value.trim();
    const course = document.getElementById('studentCourse').value.trim();
    
    if (!name || /\d/.test(name)) return alert('Invalid name');
    if (!age || isNaN(age)) return alert('Age must be a number');
    if (!course) return alert('Course required');
    
    const newId = nextId++;
    students.push({ id: newId, name, age: parseInt(age), course });
    lastAddedId = newId;
    updateTable();
    
    setTimeout(() => {
        lastAddedId = null;
        updateTable();
    }, 3000);
    
    e.target.reset();
});
