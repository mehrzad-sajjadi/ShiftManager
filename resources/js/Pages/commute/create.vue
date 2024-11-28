<template>
    <Head title="Create new Employee" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Employee
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div
                class="flex flex-row items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">ایجاد کارمند جدید</p>
            </div>
            <div class="flex flex-col justify-between">
                <div>
                    <div class="flex flex-row mb-5 py-2 px-2 w-full">
                        <div class="">
                            <label
                                class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                            >
                                نام کارمند
                            </label>
                            <select
                                v-model="form.employee_id"
                                class="rounded-lg"
                            >
                                <option
                                    class="rounded-lg w-3"
                                    v-for="(employee, index) in employees"
                                    :key="index"
                                    :value="employee.id"
                                >
                                    {{ employee.name }}
                                </option>
                            </select>

                            <!-- <p v-if="$page.props.errors.name" class="text-red-600">
                                {{ $page.props.errors.name }}
                            </p> -->
                        </div>
                        <div class="mx-8">
                            <label
                                class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                            >
                                روز
                            </label>
                            <select v-model="form.day" class="rounded-lg">
                                <option
                                    class="rounded-lg w-3"
                                    v-for="(day, index) in days"
                                    :key="index"
                                    :value="day"
                                >
                                    {{ day }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label
                            class="mt-8 block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            ساعت ورود
                        </label>
                        <date-picker
                            type="time"
                            v-model="form.enter"
                        ></date-picker>
                        <label
                            class="mt-8 block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            ساعت خروج
                        </label>
                        <date-picker
                            type="time"
                            v-model="form.exit"
                        ></date-picker>
                    </div>
                </div>
                <p
                    class="flex flex-row justify-center text-xl text-center pt-5 text-red-600"
                    v-if="$page.props.errors"
                >
                    <span v-for="(error, index) in errors" :key="index">
                        {{ error }}
                    </span>
                </p>

                <div class="flex flex-row justify-between mb-4">
                    <button
                        @click="submit"
                        type="button"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-600 hover:border-transparent"
                    >
                        ثبت ورود
                    </button>
                    <Link
                        :href="route('commute.index')"
                        type="button"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-[#ffc107] hover:bg-[#ffe607] text-black border border-[#ffc107] hover:border-transparent"
                    >
                        انصراف
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import { Head, useForm, Link, usePage } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Vue3PersianDatetimePicker from "vue3-persian-datetime-picker";
import DatePicker from "vue3-persian-datetime-picker";

export default {
    props: {
        errors: Object,
        employees: Object,
        days: Object,
    },
    setup(props) {
        const form = useForm({
            enter: "",
            exit: "",
            day: "",
            employee_id: "",
        });
        function submit() {
            form.post(route("commute.store"), {});
        }
        return { submit, form };
    },
    components: {
        Vue3PersianDatetimePicker,
        DatePicker,
        Head,
        useForm,
        Link,
        usePage,
        Dashboard,
        AuthenticatedLayout,
    },
};
</script>
