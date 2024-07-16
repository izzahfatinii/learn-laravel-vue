<template>
    <div>
        <h1 class="font-bold text-2xl">Computed Properties</h1>

        <p>Has published books:</p>
        <!-- <span>{{ author.books.length > 0 ? 'Yes' : 'No' }}</span> -->
        {{ publishedBooksMessage }} <br />
        {{ now }} | {{ now2() }}
    </div>
    <br />
    <div>
        <h1>Full Name Example</h1>
        <p>First Name: {{ firstName }}</p>
        <p>Last Name: {{ lastName }}</p>
        <p>Full Name: {{ fullName }}</p>

        <!-- Input fields for first and last name -->
        <input v-model="firstName" placeholder="First Name" />
        <input v-model="lastName" placeholder="Last Name" />

        <!-- Input field for full name -->
        <input v-model="fullName" placeholder="Full Name" />
    </div>
    <div>
        <h1 class="font-bold text-2xl">Class and Style Bindings</h1>
        <h1 class="font-bold text-xl">Binding to Objects</h1>

        <!-- Toggle properties -->
        <label> <input type="checkbox" v-model="isActive" /> isActive </label>

        <label> <input type="checkbox" v-model="hasError" /> hasError </label>
        <div
            class="static"
            :class="{ active: isActive, 'text-danger': hasError }"
        >
            This div has dynamic classes!
        </div>

        <!-- Toggle classObject properties -->
        <label>
            <input type="checkbox" v-model="classObject.active" /> active
        </label>

        <label>
            <input type="checkbox" v-model="classObject['text-danger']" />
            text-danger
        </label>
        <div :class="classObject">Try another div with dynamic classes!</div>

        <!-- Toggle properties using computed -->
        <label> <input type="checkbox" v-model="isActive2" /> isActive2 </label>
        <label>
            <input type="checkbox" @click="checkErrorValue()" v-model="error" />
            error
        </label>
        <div :class="classObject2">This div has dynamic classes!</div>
    </div>
    <div>
        <h1 class="font-bold text-xl">Binding to Arrays</h1>

        <div :class="[activeClass, errorClass]">
            <p>This is a sample element with dynamic classes.</p>
            <!-- not based on isActive status -->
            <SecondaryButton @click="toggleClasses"
                >Toggle Classes</SecondaryButton
            >
        </div>

        <div :class="[isActive3 ? activeClass : '', errorClass]">
            <!-- Different output with below -->
            <p>This is a sample element with conditional classes.</p>
            <SecondaryButton @click="toggleIsActive3"
                >Toggle isActive3</SecondaryButton
            >
        </div>

        <div :class="[{ active: isActive3 }, errorClass]">
            <!-- Different output with above -->
            <p>This is a sample element with conditional classes.</p>
            <SecondaryButton @click="toggleIsActive3"
                >Toggle isActive3</SecondaryButton
            >
        </div>
    </div>

    <br /><br /><br />
</template>

<script setup>
import { ref, reactive, computed } from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const author = reactive({
    name: "John Doe",
    books: [
        "Vue 2 - Advanced Guide",
        "Vue 3 - Basic Guide",
        "Vue 4 - The Mystery",
    ],
});

const publishedBooksMessage = computed(() => {
    return author.books.length > 0 ? "Yes" : "No";
});

const now = computed(() => Date.now());
const now2 = () => new Date().toLocaleString();

// Writable Computed
const firstName = ref("John");
const lastName = ref("Doe");

const fullName = computed({
    get() {
        return firstName.value + " " + lastName.value;
    },
    set(newValue) {
        [firstName.value, lastName.value] = newValue.split(" ");
    },
});

// Class and Style Bindings
// Binding with Objects
const isActive = ref(true);
const hasError = ref(false);

const classObject = reactive({
    active: true,
    "text-danger": false,
});

const isActive2 = ref(true);
const error = ref(null);

const classObject2 = computed(() => ({
    active: isActive2.value && !error.value,
    //   'text-danger': error.value && error.value.type, // Not working
    "text-danger": error.value,
}));

console.log(error.value);
const checkErrorValue = () => {
    console.log(error.value);
    console.log(error.value.type);
};

// Binding with Array
const activeClass = ref("active");
const errorClass = ref("text-danger");

const toggleClasses = () => {
    activeClass.value = activeClass.value === "active" ? "" : "active";
    errorClass.value = errorClass.value === "text-danger" ? "" : "text-danger";
};

const isActive3 = ref(true);

const toggleIsActive3 = () => {
    isActive3.value = !isActive3.value;
};
</script>

<style>
.static {
    padding: 10px;
    border: 1px solid #ccc;
    font-weight: bold;
    color: blue;
}

.active {
    background-color: lightgreen;
}

.text-danger {
    color: red;
}
</style>
