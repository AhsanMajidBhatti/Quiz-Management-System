<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Online Examinations
                        <span class="float-right" v-show="questionIndex !== quizQuestions.length">{{ questionIndex+1 }}/{{ quizQuestions.length }}</span>
                    </div>

                    <div class="card-body">
                            <span class="float-right" style="color: red;">{{ time }}</span>

                        <div v-for="(question, Index) in questions">
                            <div v-show="Index === questionIndex">
                            {{ question.question }}

                            <ol>
                                <li v-for="answer in question.answers">
                                    <label>
                                        <input type="radio"
                                            :value="answer.is_correct==true?true:answer.answer"
                                            :name="Index"
                                            v-model="userResponses[Index]"
                                            @click="choices(question.id, answer.id)"
                                        >{{ answer.answer }}</input>
                                    </label>
                                </li>
                            </ol>
                            </div>
                        </div>

                        <div v-show="questionIndex !== quizQuestions.length">
                            <button class="btn btn-primary float-right" @click="next(); postuserChoice();">Next</button>
                            <button v-if="questionIndex>0" class="btn btn-primary" @click="prev()">Prev</button>
                        </div>
                        <div v-show="questionIndex === quizQuestions.length">
                            <center>
                            <p>Quiz Completed. Your Score: {{ score() }}/{{ quizQuestions.length }}</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
var moment = require("moment");
export default {
    props: ["times", "quizQuestions", "hasQuizPlayed", "quizid"],
    data() {
        return {
            questions: this.quizQuestions,
            questionIndex: 0,
            userResponses: Array(this.quizQuestions.length).fill(false),
            currentQuestion: 0,
            currentAnswer: 0,
            clock: moment(this.times*60*1000)
        };
    },
    mounted() {
        setInterval(() => {
            this.clock = moment(this.clock.subtract(1, 'seconds'))
        }, 1000);
    },
    computed:{
        time:function(){
            var minsec = this.clock.format('mm:ss');
            if(minsec == "00:00"){
                alert('Timeout!');
                window.location.reload();
            }
            return minsec;
        }
    },
    methods: {
        next(){
            this.questionIndex++;
        },
        prev(){
            if(this.questionIndex >= 1){
                this.questionIndex--;
            }
        },
        choices(question, answer){
            this.currentQuestion = question;
            this.currentAnswer = answer;
        },
        score(){
            return this.userResponses.filter((val) => {
                return val === true
            }).length;
        },
        postuserChoice(){
            axios.post('/user/quiz/create', {
                answerId: this.currentAnswer,
                questionId: this.currentQuestion,
                quiz_id: this.quizid
            }).then(response => {
                console.log(response)
            }).catch(error => {
                alert("Error");
            });
        }
    }
};
</script>
