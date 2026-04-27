import AppLayout from '@/layouts/app-layout';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/react';
import axios from 'axios';
import React from "react";
import {
  useReactTable,
  getCoreRowModel,
  flexRender,
  createColumnHelper,
} from "@tanstack/react-table";
import { Eye, Pencil, Trash2, Download } from "lucide-react";

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'History',
        href: '/history',
    },
];

type Info = {
    id: number;
    name: string;
    payment: string;
    payment_for: string;
    phone: string;
    email: string;
    amount: string;
    transactionid: string;
    updated_at: string;
    created_at: string;
};

type Linkr = {
    url: string | null;
    label: string;
    page: number;
    active: boolean;
};


type Props = {
    info: {
        data: Info[];
        links: Linkr[];
    };
};
type PageProps = {

    blip?: {
        show?: string;
    };
};
// type Receipt = {
//   id: number;
//   name: string;
//   amount: number;
//   description: string;
//   payment: string;
// };

// const data: Receipt[] = [
//   { id: 1, name: "John Doe", amount: 5000, description: "Just a desc", payment: "cash" },
//   { id: 2, name: "Mary Jane", amount: 12000, description: "Lorem Ipsum", payment: "online" },
// ];

// const { infos } = usePage<PageProps>().props;

// const columnHelper = createColumnHelper<Props>();


export default function History({ info } : Props){

    //     const columns = [
    //     columnHelper.accessor("info.data.name", {
    //     header: "Name",
    //     cell: info => info.getValue(),
    //     }),

    //     columnHelper.accessor("info.data.amount", {
    //     header: "Amount",
    //     cell: info => `₦${info.getValue()}`,
    //     }),

    //     columnHelper.accessor("info.data.payment_for", {
    //     header: "Description",
    //     cell: info => `${info.getValue()}`,
    //     }),

    //     columnHelper.accessor("info.data.payment", {
    //     header: "Method",
    //     cell: info => info.getValue(),
    //     }),

    //     columnHelper.display({
    //     id: "actions",
    //     header: "Actions",
    //     cell: ({ row }) => (
    //         <div className="flex gap-3">
    //         {/* <button>
    //             <Eye size={18} className="text-blue-500" />
    //         </button> */}

    //         <button>
    //             <Download size={18} className="text-green-500" />
    //         </button>

    //         {/* <button>
    //             <Trash2 size={18} className="text-red-500" />
    //         </button> */}
    //         </div>
    //     ),
    //     }),
    // ];

    // const table = useReactTable({
    //     data,
    //     columns,
    //     getCoreRowModel: getCoreRowModel(),
    // });

        const downloadReceipt = async (id: string, val: string) => {
            try {
                const response = await axios.get(
                    route("erep.download", id),
                    {
                        responseType: "blob",
                    }
                );

                const url = window.URL.createObjectURL(
                    new Blob([response.data], { type: "application/pdf" })
                );

                const link = document.createElement("a");
                link.href = url;
                link.download = `${val}~${id}.pdf`;
                document.body.appendChild(link);
                link.click();
                link.remove();
                window.URL.revokeObjectURL(url);

            } catch (error) {
                console.error(error);
            }
        };

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="History" />

                <div className="min-h-screen bg-gray-100 flex items-center justify-center p-5">
                    <div className="w-full max-screen_lg bg-white rounded-2xl shadow-xl p-8">
                        <h1 className="text-2xl font-bold mb-6">History</h1>
                            <table className="w-full border-collapse">
                                {/* <thead>
                                    {table.getHeaderGroups().map(group => (
                                        <tr key={group.id} className="border-b">
                                        {group.headers.map(header => (
                                            <th key={header.id} className="text-left py-3">
                                            {flexRender(header.column.columnDef.header, header.getContext())}
                                            </th>
                                        ))}
                                        </tr>
                                    ))};
                                </thead> */}

                                <thead>
                                    <tr className="border-b">
                                        {/* <th className="text-left py-3">
                                            ID
                                        </th> */}
                                        <th className="text-left py-3">
                                            Name
                                        </th>
                                        <th className="text-left py-3">
                                            Description
                                        </th>
                                        <th className="text-left py-3">
                                            Amount
                                        </th>
                                        <th className="text-left py-3">
                                            Method
                                        </th>
                                        <th className="text-left py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    { info.data.map((data, index) => (
                                        <tr key={data.id} style={{ cursor: 'pointer'}} className="border-b hover:bg-gray-50">
                                            {/* <td className="py-3">
                                                { index + 1 }
                                            </td> */}
                                            <td className="py-3">
                                                { data.name }
                                            </td>
                                            <td className="py-3">
                                                { data.payment_for }
                                            </td>
                                            <td className="py-3">
                                                { data.amount }
                                            </td>
                                            <td style= {{ textTransform: 'capitalize'}}className="py-3">
                                                { data.payment }
                                            </td>
                                            <td className="py-3">
                                                <button onClick={() => downloadReceipt(data.transactionid, data.name)}><Download size={20} className="text-green-500" /></button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                                <tfoot>
                                    <tr className='border-b'>
                                        <div className="py-12 px-4">
                                            {info.links.map((link, index) => (
                                                link.url ? (
                                                    <Link className={`p-1 mx-1 ${ link.active ? "text-blue-500 font-bold" : '' }` } href={link.url} key={link.label} dangerouslySetInnerHTML={{ __html: link.label}}/>
                                                ) : 
                                                    <span key={index} className="p-1 mx-1 text-slate-300" dangerouslySetInnerHTML={{ __html: link.label }}/>
                                            ))}
                                        </div>
                                    </tr>
                                </tfoot>
                                
                            </table>
                    </div>
                </div>
        </AppLayout>
    );
}