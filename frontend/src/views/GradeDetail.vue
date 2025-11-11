<template>
  <section>
    <h2 class="text-2xl font-semibold mb-4">Grade details</h2>
    <div v-if="!grade">Loading...</div>
    <div v-else class="bg-white p-4 rounded shadow">
      <p><strong>ID:</strong> {{ grade.id }}</p>
      <p><strong>Student:</strong> {{ grade.studentName }}</p>
      <p><strong>Subject:</strong> {{ grade.subjectName }}</p>
      <p><strong>Grade:</strong> {{ grade.grade }}</p>
      <p><strong>Date:</strong> {{ grade.date }}</p>
    </div>
  </section>
</template>

<script>
import axios from 'axios'
import { ref, onMounted } from 'vue'

export default {
  props: ['id'],
  setup(props) {
    const grade = ref(null)
    const load = async () => {
      const res = await axios.get(`/api/grades/${props.id}`)
      grade.value = res.data
    }
    onMounted(load)
    return { grade }
  }
}
</script>
