<template>
  <div class="min-h-screen bg-gray-100">
    <nav class="bg-indigo-600 text-white shadow">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
          <div class="flex items-center">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
          </div>
          <div class="flex items-center">
            <span class="text-sm mr-4">{{ adminName }}</span>
            <button @click="logout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
          </div>
        </div>
      </div>
    </nav>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
      <div class="mb-6 border-b border-gray-200">
        <nav class="-mb-px flex space-x-8">
          <button
            v-for="tab in tabs"
            :key="tab.id"
            @click="currentTab = tab.id"
            :class="[
              currentTab === tab.id
                ? 'border-indigo-500 text-indigo-600'
                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
              'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm'
            ]"
          >
            {{ tab.name }}
          </button>
        </nav>
      </div>

      <!-- Students -->
      <section v-if="currentTab === 'students'" class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Manage Students</h2>
          <button @click="showAddStudent = true" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Student</button>
        </div>
        <div v-if="showAddStudent || editingStudent" class="mt-4 bg-gray-50 p-4 rounded">
          <h3 class="font-medium mb-2">{{ editingStudent ? 'Edit Student' : 'Add Student' }}</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <input v-model="studentForm.firstName" placeholder="First Name" class="p-2 border rounded" />
            <input v-model="studentForm.lastName" placeholder="Last Name" class="p-2 border rounded" />
            <input v-model="studentForm.email" placeholder="Email" class="p-2 border rounded" />
            <input v-model="studentForm.password" type="password" placeholder="Password" class="p-2 border rounded" />
          </div>
          <div class="mt-3">
            <button @click="saveStudent" class="bg-indigo-600 text-white px-4 py-2 rounded mr-2">Save</button>
            <button @click="cancelStudent" class="px-4 py-2 rounded border">Cancel</button>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="student in students" :key="student.id">
                <td class="px-6 py-4">{{ student.id }}</td>
                <td class="px-6 py-4">{{ student.firstName }} {{ student.lastName }}</td>
                <td class="px-6 py-4">
                  <button @click="editStudent(student)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                  <button @click="deleteStudent(student.id)" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Subjects -->
      <section v-if="currentTab === 'subjects'" class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Manage Subjects</h2>
          <button @click="showAddSubject = true" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Subject</button>
        </div>
        <div v-if="showAddSubject || editingSubject" class="mt-4 bg-gray-50 p-4 rounded">
          <h3 class="font-medium mb-2">{{ editingSubject ? 'Edit Subject' : 'Add Subject' }}</h3>
          <div class="grid grid-cols-1 gap-3">
            <input v-model="subjectForm.code" placeholder="Subject Code" class="p-2 border rounded" />
            <input v-model="subjectForm.name" placeholder="Subject Name" class="p-2 border rounded" />
            <textarea v-model="subjectForm.description" placeholder="Description" class="p-2 border rounded" rows="3"></textarea>
          </div>
          <div class="mt-3">
            <button @click="saveSubject" class="bg-indigo-600 text-white px-4 py-2 rounded mr-2">Save</button>
            <button @click="cancelSubject" class="px-4 py-2 rounded border">Cancel</button>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="subject in subjects" :key="subject.id">
                <td class="px-6 py-4">{{ subject.code }}</td>
                <td class="px-6 py-4">{{ subject.name }}</td>
                <td class="px-6 py-4">
                  <button @click="editSubject(subject)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                  <button @click="deleteSubject(subject.id)" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Grades -->
      <section v-if="currentTab === 'grades'" class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Manage Grades</h2>
          <button @click="showAddGrade = true" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Grade</button>
        </div>
        <div v-if="showAddGrade || editingGrade" class="mt-4 bg-gray-50 p-4 rounded">
          <h3 class="font-medium mb-2">{{ editingGrade ? 'Edit Grade' : 'Add Grade' }}</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <select v-model="gradeForm.studentId" class="p-2 border rounded">
              <option value="">Select Student</option>
              <option v-for="student in students" :key="student.id" :value="student.id">
                {{ student.firstName }} {{ student.lastName }}
              </option>
            </select>
            <select v-model="gradeForm.subjectId" class="p-2 border rounded">
              <option value="">Select Subject</option>
              <option v-for="subject in subjects" :key="subject.id" :value="subject.id">
                {{ subject.name }}
              </option>
            </select>
            <input v-model="gradeForm.grade" type="number" min="0" max="100" placeholder="Grade" class="p-2 border rounded" />
          </div>
          <div class="mt-3">
            <button @click="saveGrade" class="bg-indigo-600 text-white px-4 py-2 rounded mr-2">Save</button>
            <button @click="cancelGrade" class="px-4 py-2 rounded border">Cancel</button>
          </div>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="grade in grades" :key="grade.id">
                <td class="px-6 py-4">{{ grade.studentName }}</td>
                <td class="px-6 py-4">{{ grade.subjectName }}</td>
                <td class="px-6 py-4">{{ grade.grade }}</td>
                <td class="px-6 py-4">
                  <button @click="editGrade(grade)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                  <button @click="deleteGrade(grade.id)" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Professors -->
      <section v-if="currentTab === 'professors'" class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Manage Professors</h2>
          <button @click="showAddProfessor = true" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Add Professor</button>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead>
              <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Department</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="prof in professors" :key="prof.id">
                <td class="px-6 py-4">{{ prof.username }}</td>
                <td class="px-6 py-4">{{ prof.name }}</td>
                <td class="px-6 py-4">{{ prof.department }}</td>
                <td class="px-6 py-4">
                  <button @click="editProfessor(prof)" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                  <button @click="deleteProfessor(prof.id)" class="text-red-600 hover:text-red-900">Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <div v-if="showAddProfessor || editingProfessor" class="mt-4 bg-gray-50 p-4 rounded">
          <h3 class="font-medium mb-2">{{ editingProfessor ? 'Edit Professor' : 'Add Professor' }}</h3>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <input v-model="profForm.username" placeholder="Username" class="p-2 border rounded" />
            <input v-model="profForm.password" placeholder="Password" class="p-2 border rounded" />
            <input v-model="profForm.name" placeholder="Name" class="p-2 border rounded" />
            <input v-model="profForm.department" placeholder="Department" class="p-2 border rounded" />
            <input v-model="profForm.email" placeholder="Email" class="p-2 border rounded md:col-span-2" />
          </div>
          <div class="mt-3">
            <button @click="saveProfessor" class="bg-indigo-600 text-white px-4 py-2 rounded mr-2">Save</button>
            <button @click="cancelProfessor" class="px-4 py-2 rounded border">Cancel</button>
          </div>
        </div>
      </section>

      <!-- Announcements -->
      <section v-if="currentTab === 'announcements'" class="bg-white shadow rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center mb-4">
          <h2 class="text-xl font-semibold">Manage Announcements</h2>
          <button @click="showAddAnnouncement = true" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">New Announcement</button>
        </div>
        <div class="space-y-4">
          <div v-for="ann in announcements" :key="ann.id" class="p-4 border rounded">
            <div class="flex justify-between items-start">
              <div>
                <h3 class="font-semibold">{{ ann.title }}</h3>
                <p class="text-sm text-gray-600">{{ ann.date }}</p>
              </div>
              <div>
                <button @click="editAnnouncement(ann)" class="text-indigo-600 mr-3">Edit</button>
                <button @click="deleteAnnouncement(ann.id)" class="text-red-600">Delete</button>
              </div>
            </div>
            <p class="mt-2 text-gray-700">{{ ann.content }}</p>
          </div>
        </div>

        <div v-if="showAddAnnouncement || editingAnnouncement" class="mt-4 bg-gray-50 p-4 rounded">
          <h3 class="font-medium mb-2">{{ editingAnnouncement ? 'Edit Announcement' : 'New Announcement' }}</h3>
          <input v-model="annForm.title" placeholder="Title" class="w-full p-2 border rounded mb-2" />
          <textarea v-model="annForm.content" placeholder="Content" class="w-full p-2 border rounded mb-2" rows="4"></textarea>
          <input v-model="annForm.date" type="date" class="p-2 border rounded mb-2" />
          <div>
            <button @click="saveAnnouncement" class="bg-indigo-600 text-white px-4 py-2 rounded mr-2">Save</button>
            <button @click="cancelAnnouncement" class="px-4 py-2 rounded border">Cancel</button>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const API_URL = 'http://localhost:3000'

const adminName = ref('')
const currentTab = ref('students')
const students = ref([])
const subjects = ref([])
const grades = ref([])
const professors = ref([])
const announcements = ref([])

const tabs = [
  { id: 'students', name: 'Students' },
  { id: 'subjects', name: 'Subjects' },
  { id: 'grades', name: 'Grades' },
  { id: 'professors', name: 'Professors' },
  { id: 'announcements', name: 'Announcements' }
]

// UI state
const showAddStudent = ref(false)
const editingStudent = ref(null)
const studentForm = ref({ firstName: '', lastName: '', email: '', password: '' })

const showAddProfessor = ref(false)
const editingProfessor = ref(null)
const profForm = ref({ username: '', password: '', name: '', department: '', email: '' })

const showAddSubject = ref(false)
const editingSubject = ref(null)
const subjectForm = ref({ code: '', name: '', description: '' })

const showAddGrade = ref(false)
const editingGrade = ref(null)
const gradeForm = ref({ studentId: '', subjectId: '', grade: '' })

const showAddAnnouncement = ref(false)
const editingAnnouncement = ref(null)
const annForm = ref({ title: '', content: '', date: '' })

onMounted(async () => {
  const adminData = localStorage.getItem('admin')
  if (!adminData) {
    router.push('/admin-login')
    return
  }
  const admin = JSON.parse(adminData)
  adminName.value = admin.name || 'Admin'

  // Load initial data
  await loadStudents()
  await loadSubjects()
  await loadGrades()
  await loadProfessors()
  await loadAnnouncements()
})

async function loadStudents() {
  try {
    const res = await fetch(`${API_URL}/api/auth`)
    students.value = await res.json()
  } catch (error) {
    console.error('Error loading students:', error)
  }
}

async function loadSubjects() {
  try {
    const res = await fetch(`${API_URL}/api/subjects`)
    subjects.value = await res.json()
  } catch (error) {
    console.error('Error loading subjects:', error)
  }
}

async function loadGrades() {
  try {
    const res = await fetch(`${API_URL}/api/grades`)
    grades.value = await res.json()
  } catch (error) {
    console.error('Error loading grades:', error)
  }
}

async function loadProfessors() {
  try {
    const res = await fetch(`${API_URL}/api/staff/professors`)
    const data = await res.json()
    professors.value = Array.isArray(data) ? data : []
  } catch (error) {
    console.error('Error loading professors:', error)
  }
}

async function loadAnnouncements() {
  try {
    const res = await fetch(`${API_URL}/api/announcements`)
    announcements.value = await res.json()
  } catch (error) {
    console.error('Error loading announcements:', error)
  }
}

function editAnnouncement(a) {
  editingAnnouncement.value = a
  annForm.value = { title: a.title || '', content: a.content || '', date: a.date ? a.date.slice(0,10) : '' }
  showAddAnnouncement.value = false
}

function cancelAnnouncement() {
  showAddAnnouncement.value = false
  editingAnnouncement.value = null
  annForm.value = { title: '', content: '', date: '' }
}

async function saveAnnouncement() {
  try {
    if (editingAnnouncement.value) {
      const id = editingAnnouncement.value.id
      const res = await fetch(`${API_URL}/api/announcements/${id}`, { method: 'PUT', headers: { 'Content-Type':'application/json' }, body: JSON.stringify(annForm.value) })
      if (!res.ok) throw new Error('Update failed')
    } else {
      const res = await fetch(`${API_URL}/api/announcements`, { method: 'POST', headers: { 'Content-Type':'application/json' }, body: JSON.stringify(annForm.value) })
      if (!res.ok) throw new Error('Create failed')
    }
    await loadAnnouncements()
    cancelAnnouncement()
  } catch (error) {
    console.error('Error saving announcement:', error)
    alert('Error saving announcement. See console.')
  }
}

function editStudent(student) {
  editingStudent.value = student
  studentForm.value = {
    firstName: student.firstName,
    lastName: student.lastName,
    email: student.email,
    password: ''  
  }
  showAddStudent.value = false
}

function cancelStudent() {
  showAddStudent.value = false
  editingStudent.value = null
  studentForm.value = { firstName: '', lastName: '', email: '', password: '' }
}

async function saveStudent() {
  try {
    if (editingStudent.value) {
      const id = editingStudent.value.id
      await fetch(`${API_URL}/api/auth/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(studentForm.value)
      })
    } else {
      await fetch(`${API_URL}/api/auth/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(studentForm.value)
      })
    }
    await loadStudents()
    cancelStudent()
  } catch (error) {
    console.error('Error saving student:', error)
    alert('Error saving student. See console.')
  }
}

function editProfessor(p) {
  editingProfessor.value = p
  profForm.value = { username: p.username || '', password: '', name: p.name || '', department: p.department || '', email: p.email || '' }
  showAddProfessor.value = false
}

function cancelProfessor() {
  showAddProfessor.value = false
  editingProfessor.value = null
  profForm.value = { username: '', password: '', name: '', department: '', email: '' }
}

async function saveProfessor() {
  try {
    if (editingProfessor.value) {
      const id = editingProfessor.value.id
      const body = { name: profForm.value.name, department: profForm.value.department, email: profForm.value.email }
      if (profForm.value.password) body.password = profForm.value.password
      const res = await fetch(`${API_URL}/api/staff/professors/${id}`, { method: 'PUT', headers: { 'Content-Type':'application/json' }, body: JSON.stringify(body) })
      if (!res.ok) throw new Error('Update failed')
    } else {
      const res = await fetch(`${API_URL}/api/staff/professors`, { method: 'POST', headers: { 'Content-Type':'application/json' }, body: JSON.stringify(profForm.value) })
      if (!res.ok) throw new Error('Create failed')
    }
    await loadProfessors()
    cancelProfessor()
  } catch (error) {
    console.error('Error saving professor:', error)
    alert('Error saving professor. See console.')
  }
}

async function deleteProfessor(id) {
  if (!confirm('Delete professor?')) return
  try {
    const res = await fetch(`${API_URL}/api/staff/professors/${id}`, { method: 'DELETE' })
    if (!res.ok) throw new Error('Delete failed')
    await loadProfessors()
  } catch (error) {
    console.error('Error deleting professor:', error)
    alert('Error deleting professor. See console.')
  }
}

function editSubject(subject) {
  editingSubject.value = subject
  subjectForm.value = {
    code: subject.code,
    name: subject.name,
    description: subject.description
  }
  showAddSubject.value = false
}

function cancelSubject() {
  showAddSubject.value = false
  editingSubject.value = null
  subjectForm.value = { code: '', name: '', description: '' }
}

async function saveSubject() {
  try {
    if (editingSubject.value) {
      const id = editingSubject.value.id
      await fetch(`${API_URL}/api/subjects/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(subjectForm.value)
      })
    } else {
      await fetch(`${API_URL}/api/subjects`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(subjectForm.value)
      })
    }
    await loadSubjects()
    cancelSubject()
  } catch (error) {
    console.error('Error saving subject:', error)
    alert('Error saving subject. See console.')
  }
}

function editGrade(grade) {
  editingGrade.value = grade
  gradeForm.value = {
    studentId: grade.studentId,
    subjectId: grade.subjectId,
    grade: grade.grade
  }
  showAddGrade.value = false
}

function cancelGrade() {
  showAddGrade.value = false
  editingGrade.value = null
  gradeForm.value = { studentId: '', subjectId: '', grade: '' }
}

async function saveGrade() {
  try {
    if (editingGrade.value) {
      const id = editingGrade.value.id
      await fetch(`${API_URL}/api/grades/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(gradeForm.value)
      })
    } else {
      await fetch(`${API_URL}/api/grades`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(gradeForm.value)
      })
    }
    await loadGrades()
    cancelGrade()
  } catch (error) {
    console.error('Error saving grade:', error)
    alert('Error saving grade. See console.')
  }
}

async function deleteAnnouncement(id) {
  if (!confirm('Delete announcement?')) return
  try {
    const res = await fetch(`${API_URL}/api/announcements/${id}`, { method: 'DELETE' })
    if (!res.ok) throw new Error('Delete failed')
    await loadAnnouncements()
  } catch (error) {
    console.error('Error deleting announcement:', error)
    alert('Error deleting announcement. See console.')
  }
}

async function deleteSubject(id) {
  if (!confirm('Are you sure you want to delete this subject?')) return
  try {
    await fetch(`${API_URL}/api/subjects/${id}`, { method: 'DELETE' })
    await loadSubjects()
  } catch (error) {
    console.error('Error deleting subject:', error)
  }
}

async function deleteStudent(id) {
  if (!confirm('Are you sure you want to delete this student?')) return
  try {
    await fetch(`${API_URL}/api/auth/${id}`, { method: 'DELETE' })
    await loadStudents()
  } catch (error) {
    console.error('Error deleting student:', error)
  }
}

async function deleteGrade(id) {
  if (!confirm('Are you sure you want to delete this grade?')) return
  try {
    await fetch(`${API_URL}/api/grades/${id}`, { method: 'DELETE' })
    await loadGrades()
  } catch (error) {
    console.error('Error deleting grade:', error)
  }
}

function logout() {
  localStorage.removeItem('admin')
  router.push('/admin-login')
}
</script>