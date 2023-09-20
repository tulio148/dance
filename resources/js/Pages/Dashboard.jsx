import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";
import SelectInput from "@/Components/SelectInput";

export default function Dashboard({ auth }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        title: "",
        datetime: "",
        description: "",
        style: "",
        level: "",
        instructor: "",
        enrollment_mode: "",
        location: "",
        price: "",
    });

    const submit = (e) => {
        e.preventDefault();
        console.log(data);
        post(route("class.store"));
    };

    const test = (e) => {
        post(route("order.store"));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <form onSubmit={submit}>
                            <div className="flex flex-col gap-2 p-3">
                                <InputLabel htmlFor="title" value="Title" />
                                <TextInput
                                    id="title"
                                    name="title"
                                    value={data.title}
                                    className="mt-1 block w-full"
                                    autoComplete="title"
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData("title", e.target.value)
                                    }
                                    required
                                />
                                <InputError
                                    message={errors.title}
                                    className="mt-2"
                                />
                                <InputLabel
                                    htmlFor="datetime"
                                    value="datetime"
                                />
                                <TextInput
                                    id="datetime"
                                    type="datetime-local"
                                    name="datetime"
                                    value={data.datetime}
                                    className="mt-1 block w-full"
                                    autoComplete="datetime"
                                    onChange={(e) =>
                                        setData("datetime", e.target.value)
                                    }
                                    required
                                />
                                <InputError
                                    message={errors.datetime}
                                    className="mt-2"
                                />
                                <InputLabel
                                    htmlFor="description"
                                    value="description"
                                />
                                <TextInput
                                    id="description"
                                    name="description"
                                    value={data.description}
                                    className="mt-1 block w-full"
                                    autoComplete="description"
                                    onChange={(e) =>
                                        setData("description", e.target.value)
                                    }
                                    required
                                />
                                <InputError
                                    message={errors.description}
                                    className="mt-2"
                                />

                                <InputLabel htmlFor="level" value="Level" />

                                <SelectInput
                                    options={["", "beginner", "advanced"]}
                                    className="mt-1 block w-full"
                                    value={data.level}
                                    onChange={(e) => {
                                        setData("level", e.target.value);
                                    }}
                                    required
                                />
                                <InputLabel htmlFor="style" value="style" />
                                <SelectInput
                                    options={["", "samba", "other"]}
                                    className="mt-1 block w-full"
                                    value={data.style}
                                    onChange={(e) => {
                                        setData("style", e.target.value);
                                    }}
                                    required
                                />
                                <InputLabel
                                    htmlFor="instructor"
                                    value="instructor"
                                />
                                <SelectInput
                                    options={["", "Jane Doe", "That One"]}
                                    className="mt-1 block w-full"
                                    value={data.instructor}
                                    onChange={(e) => {
                                        setData("instructor", e.target.value);
                                    }}
                                    required
                                />
                                <InputLabel
                                    htmlFor="enrollment mode"
                                    value="enrollment mode"
                                />
                                <SelectInput
                                    options={["", "single", "term"]}
                                    className="mt-1 block w-full"
                                    value={data.enrollment_mode}
                                    onChange={(e) => {
                                        setData(
                                            "enrollment_mode",
                                            e.target.value
                                        );
                                    }}
                                    required
                                />
                                <InputLabel
                                    htmlFor="location   "
                                    value="location "
                                />
                                <SelectInput
                                    options={["", "the studio"]}
                                    className="mt-1 block w-full"
                                    value={data.location}
                                    onChange={(e) => {
                                        setData("location", e.target.value);
                                    }}
                                    required
                                />

                                <InputLabel htmlFor="price" value="price" />
                                <TextInput
                                    id="price"
                                    name="price"
                                    value={data.price}
                                    className="mt-1 block w-full"
                                    autoComplete="price"
                                    onChange={(e) =>
                                        setData("price", e.target.value)
                                    }
                                    required
                                />
                                <InputError
                                    message={errors.price}
                                    className="mt-2"
                                />
                                <PrimaryButton
                                    className=""
                                    disabled={processing}
                                >
                                    Save
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                    <button onClick={test}>create order</button>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
