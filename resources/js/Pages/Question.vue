<script setup>
import Layout from '../Layout/Layout.vue';
import { ref, onMounted } from 'vue'
import Modal from '../Component/Question/Modal.vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    questions: Array
})

const showModal = ref(false)
const createdQuestion = ref(null)
let newAnswers = ref([])
let answerId = 1
const selectedAnswer = ref(0)
const showDetailQuestion = ref(false)
const selectedQuestion = ref(null)
const selectedShowAnswer = ref([])

onMounted(() => {
    console.log(`render.`)
})

function handleRadioToggle(id) {
    selectedAnswer.value = id
    newAnswers.value.forEach(answer => {
        answer.correct_answer = answer.id === id ? 1 : 0;
    })
}

function addNewAnswer() {
    const newAnswer = {
        id: answerId++,
        answer: '',
        correct_answer: 0
    }
    newAnswers.value.push(newAnswer);
}

function submitQuestion() {
    router.post('/questions', {
        question: createdQuestion.value,
        answer: newAnswers.value
    })
}


function viewQuestion(id) {
    showDetailQuestion.value = true;
    selectedQuestion.value = props.questions[id]
    console.log(selectedQuestion.value)
    selectedShowAnswer.value = props.questions[id].answer
    console.log(selectedShowAnswer.value)
}
</script>

<template>
    <Layout>
        <main class="container">
            <h1>Question</h1>
            <div>
                <button type="button" class="btn btn-primary" @click="showModal = true">Add Question</button>
            </div>
            <!-- modal -->
            <Teleport to="body">
                <!-- use the modal component, pass in the prop -->
                <Modal :show="showModal" @close="showModal = false">
                    <template #header>
                        <h3>Add Question</h3>
                    </template>
                    <template #success>
                        <div v-if="$page.props.flash.message" class="alert alert-success">
                            {{ $page.props.flash.message }}
                        </div>
                    </template>
                    <template #body>
                        <div class="input-group mb-3">
                            <input v-model="createdQuestion" type="text" class="form-control" placeholder="Question"
                                aria-label="Question" aria-describedby="basic-addon1">
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(answer, index) in newAnswers" :key="index">
                                    <th scope="row">{{ answer.id }}</th>
                                    <td>
                                        <input v-model="answer.answer" type="text" class="form-control"
                                            placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </td>
                                    <td>
                                        <div class="form-check d-flex justify-content-center mt-1">
                                            <input :checked="answer.correct_answer === 1" :value="answer.id"
                                                @change="handleRadioToggle(answer.id)" class="form-check-input" type="radio"
                                                name="flexRadioDefault" id="flexRadioDefault1">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                    <template #footer>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-end">
                                <span @click="addNewAnswer" v-if="newAnswers.length < 4"
                                    class="badge bg-primary custom-pointer">
                                    +
                                </span>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                                <button v-if="newAnswers.length > 3" type="button" class="btn btn-success"
                                    @click="submitQuestion">Submit</button>
                            </div>
                        </div>
                    </template>
                </Modal>

                <Modal :show="showDetailQuestion" @close="showDetailQuestion = false">
                    <template #header>
                        <h3>Detail Question</h3>
                    </template>
                    <template #body>
                        <p><strong>{{ selectedQuestion.question }}</strong></p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(answer, index) in selectedShowAnswer" :key="index">
                                    <th scope="row">{{ answer.id }}</th>
                                    <td>
                                        <input v-model="answer.answer" type="text" class="form-control"
                                            placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                    </td>
                                    <td>
                                        <div class="form-check d-flex justify-content-center mt-1">
                                            <input :checked="answer.correct_answer === 1" :value="answer.id"
                                                @change="handleRadioToggle(answer.id)" class="form-check-input" type="radio"
                                                name="flexRadioDefault" id="flexRadioDefault1">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                    <template #footer>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-secondary"
                                    @click="showDetailQuestion = false">Close</button>
                                <button v-if="newAnswers.length > 3" type="button" class="btn btn-success"
                                    @click="submitQuestion">Submit</button>
                            </div>
                        </div>
                    </template>
                </Modal>
            </Teleport>
            <!-- end modal -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Question</th>
                        <th scope="col">Last</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(question, index) in questions" :key="index">
                        <th scope="row">{{ question.id }}</th>
                        <td>{{ question.question }}</td>
                        <td>Otto</td>
                        <td>
                            <button @click="viewQuestion(index)" class="btn btn-primary">View</button>
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </Layout>
</template>

<style>
.custom-pointer:hover {
    cursor: pointer;
}
</style>