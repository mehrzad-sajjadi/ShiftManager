<template>
    <Head title="Create new Employee" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Employee
            </h2>
        </template>

        <div
            class="flex flex-col w-5/6 mx-auto my-16 border border-gray-500 rounded-lg"
        >
            <div
                class="flex flex-row items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">
                    ویرایش اطلاعات {{ employee.name }}
                </p>
            </div>
            <div class="flex flex-col justify-between">
                <div>
                    <div class="mb-5 py-2 px-2 w-full">
                        <label
                            class="block mb-2 text-lg font-medium text-gray-900 dark:text-white"
                        >
                            نام کارمند
                        </label>
                        <input
                            type="text"
                            class="block w-[50%] p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            autofocus
                            v-model="form.name"
                        />
                        <p v-if="$page.props.errors.name" class="text-red-600">
                            {{ $page.props.errors.name }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-row justify-between mb-4">
                    <button
                        @click="update(employee.id)"
                        type="button"
                        as="button"
                        class="h-9 px-4 m-2 text-lg duration-150 rounded focus:shadow-outline bg-white hover:bg-blue-600 text-blue-600 hover:text-white border border-blue-600 hover:border-transparent"
                    >
                        ویرایش کارمند
                    </button>
                    <Link
                        :href="route('employee.index')"
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
        employee: Object,
    },
    setup(props) {
        const form = useForm({
            name: props.employee.name,
        });
        function update(id) {
            form.put(route("employee.update", id), {});
        }
        return { update, form };
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
