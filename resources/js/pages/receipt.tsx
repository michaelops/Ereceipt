import { useForm } from "@inertiajs/react";
import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage } from '@inertiajs/react';
import { useState, useEffect } from "react";
import axios from 'axios';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Generate E-Receipt',
        href: '/generate',
    },
];

type PageProps = {

    flash?: {
        message?: string;
    };
};

export default function Receipt(){

    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        email: '',
        phone: '',
        description: '',
        amount: '',
        mode: '',
    });

    // const submit = (e: React.FormEvent) => {
    //     e.preventDefault();
    //     post(route('erep.generate'), {
    //         onSuccess: () => reset(),
    //     });

    // }

    const submit = async (e: React.FormEvent) => {
        e.preventDefault();

        try {
            const response = await axios.post(route('erep.generate'), data);

            if (response.data.success) {
                setFlashMsg(response.data.message);

                window.open(response.data.download_url, "_blank");

                reset();
            }

        } catch (error: any) {
            console.error(error);
            console.log(error.response);
            console.log(error.response.data);
        }
    };

    const { props } = usePage<PageProps>();

    // const [flashMsg, setFlashMsg] = useState<string | null>(props.flash?.message ?? null);

    const [flashMsg, setFlashMsg] = useState<string | null>(null);

    useEffect(() => {
        if (props.flash?.message) {
            setFlashMsg(props.flash.message);
        }
    }, [props.flash?.message]);

    useEffect(() => {
        if (flashMsg) {
            const timer = setTimeout(() => {
                setFlashMsg(null);
            }, 5000);

            return () => clearTimeout(timer);
        }
    }, [flashMsg]);

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Generate E-Receipt" />

            { flashMsg && (
                <div className="absolute top-24 right-6 bg-green-500 p-2 rounded-md shadow-lg text-sm text-white">{ flashMsg }
                </div> 
            )}
                <div className="min-h-screen bg-gray-100 flex items-center justify-center p-5">
                    <div className="w-full max-w-lg bg-white rounded-2xl shadow-xl p-8">
                        <h1 className="text-2xl font-bold mb-6">Generate E-Receipt</h1>
                        <form onSubmit={submit} className="space-y-4">
                            <div>
                                <label className="block peer text-md font-medium text-gray-700">Name</label>
                                <input type="text" value={data.name} onChange={(e) => setData('name', e.target.value)} 
                                className='border-gray-700 border w-full p-2 rounded'/>
                                {errors.name && <p className="error text-sm mt-1 text-red-500">{errors.name}</p>}
                            </div>
                            <div>
                                <label className="block peer text-md font-medium text-gray-700">Email</label>
                                <input type="email" value={data.email} onChange={(e) => setData('email', e.target.value)} 
                                className="border-gray-700 border w-full p-2 rounded"/>
                                {errors.email && <p className="error text-sm mt-1 text-red-500">{errors.email}</p>}
                            </div>
                            <div>
                                <label className="block peer text-md font-medium text-gray-700">Phone Number</label>
                                <input type="number" value={data.phone} onChange={(e) => setData('phone', e.target.value)} 
                                className="border-gray-700 border w-full p-2 rounded"/>
                                {errors.phone && <p className="error text-sm mt-1 text-red-500">{errors.phone}</p>}
                            </div>
                            <div>
                                <label className="block peer text-md font-medium text-gray-700">Payment Description</label>
                                <input type="text" value={data.description} onChange={(e) => setData('description', e.target.value)} 
                                className="border-gray-700 border w-full p-2 rounded"/>
                                {errors.description && <p className="error text-sm mt-1 text-red-500">{errors.description}</p>}
                            </div>
                            <div>
                                <label className="block peer text-md font-medium text-gray-700">Payment Mode</label>
                                <select value={data.mode} onChange={(e) => setData('mode', e.target.value)} 
                                className="border-gray-700 border w-full p-2 rounded">
                                    <option value=''>Select a Payment Method</option>
                                    <option value='cash'>Cash</option>
                                    <option value='online'>Online</option>
                                </select>
                                {errors.mode && <p className="error text-sm mt-1 text-red-500">{errors.mode}</p>}
                            </div>
                            <div>
                                <label className="block peer text-md font-medium text-gray-700">Amount</label>
                                <input type="number" min="1" value={data.amount} onChange={(e) => setData('amount', e.target.value)} 
                                className="border-gray-700 border w-full p-2 rounded"/>
                                {errors.amount && <p className="error text-sm mt-1 text-red-500">{errors.amount}</p>}
                            </div>
                            <button type="submit" disabled={processing} className="w-full text-md font-md bg-black shadow-md text-white py-3 rounded-lg hover:opacity-90 transition">Process</button>
                        </form>
                    </div>
                </div>
        </AppLayout>
    );
}