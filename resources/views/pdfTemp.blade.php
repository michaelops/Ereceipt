<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OliveCrib INT.</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f0f4f8; font-family: DejaVu Sans, sans-serif; font-size: 14px; color: #1a202c;">

    <div style="max-width: 720px; margin: 30px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">

        {{-- ===== HEADER BANNER ===== --}}
        <div style="background-color: #2563eb; padding: 36px 40px 28px 40px; position: relative;">

            {{-- Top accent bar --}}
            <!-- <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, #f59e0b, #fbbf24, #f59e0b);"></div> -->

            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="vertical-align: middle; width: 70px;">
                        {{-- School Crest / Logo Placeholder --}}
                        <!-- <div style="width: 64px; height: 64px; background-color: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid #f59e0b;"> -->
                            <img src="images/logo.png" width="100" height="100" style="border-radius:50%;">
                            <!-- <span style="font-size: 28px; font-weight: 900; color: #1a3c6e; line-height: 64px; display: block; text-align: center;">S</span> -->
                        <!-- </div> -->
                    </td>
                    <td style="vertical-align: middle; padding-left: 0px;">
                        <div style="font-size: 22px; font-weight: 900; color: #ffffff; letter-spacing: 0.5px;">{{ $school_name ?? 'OliveCrib International' }}</div>
                        <div style="font-size: 12px; color: #bfdbfe; margin-top: 3px;">{{ $school_address ?? '14 Learning Lane, Odo-Eran, Ogun State' }}</div>
                        <div style="font-size: 12px; color: #bfdbfe; margin-top: 1px;">
                            Tel: {{ $school_phone ?? '+234 800 000 0000' }} &nbsp;|&nbsp; {{ $school_email ?? 'lorem@gmail.com' }}
                        </div>
                    </td>
                    <td style="vertical-align: middle; text-align: right; white-space: nowrap;">
                        <div style="background-color: #fff; color: #1a202c; font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; padding: 4px 14px; border-radius: 20px; display: inline-block;">Official Receipt</div>
                        <div style="color: #ffffff; font-size: 18px; font-weight: 900; margin-top: 6px; letter-spacing: 1px;">#{{ $receipt_number ?? $info->transactionid }}</div>
                        <div style="color: #93c5fd; font-size: 11px; margin-top: 3px;">Date Issued: {{ $issue_date ?? $info->created_at->format('d M, Y') }}</div>
                    </td>
                </tr>
            </table>
        </div>

        {{-- ===== STATUS STRIP ===== --}}
        <div style="background-color: #16a34a; padding: 8px 40px; text-align: center;">
            <span style="color: #ffffff; font-size: 12px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;">
                ✓ &nbsp; Payment Confirmed &nbsp; ✓
            </span>
        </div>

        {{-- ===== STUDENT & TERM INFO ===== --}}
        <div style="padding: 28px 40px 0 40px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    {{-- Student Details --}}
                    <td style="vertical-align: top; width: 80%; align-content:center">
                        <div style="background-color: #eff6ff; border-left: 4px solid #2563eb; border-radius: 0 8px 8px 0; padding: 16px 18px;">
                            <div style="font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #2563eb; margin-bottom: 10px;">PAYMENT DETAILS</div>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-bottom: 6px; padding-right: 10px; white-space: nowrap;">Full Name</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c; padding-bottom: 6px;">{{ $student_name ?? $info->name }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-bottom: 6px; padding-right: 10px; white-space: nowrap;">Phone Number</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c; padding-bottom: 6px;">{{ $student_id ?? $info->phone }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-bottom: 6px; padding-right: 10px; white-space: nowrap;">E-mail</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c; padding-bottom: 6px;">{{ $class ?? $info->email }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-right: 10px; white-space: nowrap;">Payemnt Method</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c;">{{ $parent_name ?? ucfirst($info->payment) }}</td>
                                </tr>
                            </table>
                        </div>
                    </td>

                    <td style="width: 24px;"></td>

                    {{-- Term & Payment Details --}}
                    <!-- <td style="vertical-align: top; width: 50%;">
                        <div style="background-color: #f0fdf4; border-left: 4px solid #16a34a; border-radius: 0 8px 8px 0; padding: 16px 18px;">
                            <div style="font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #16a34a; margin-bottom: 10px;">Payment Details</div>
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-bottom: 6px; padding-right: 10px; white-space: nowrap;">Academic Year</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c; padding-bottom: 6px;">{{ $academic_year ?? '2024 / 2025' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-bottom: 6px; padding-right: 10px; white-space: nowrap;">Term</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c; padding-bottom: 6px;">{{ $term ?? '2nd Term' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-bottom: 6px; padding-right: 10px; white-space: nowrap;">Payment Method</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c; padding-bottom: 6px;">{{ $payment_method ?? 'Bank Transfer' }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; color: #64748b; padding-right: 10px; white-space: nowrap;">Transaction Ref</td>
                                    <td style="font-size: 13px; font-weight: 700; color: #1a202c;">{{ $transaction_ref ?? 'TXN9843720156' }}</td>
                                </tr>
                            </table>
                        </div>
                    </td> -->
                </tr>
            </table>
        </div>

        {{-- ===== FEE BREAKDOWN TABLE ===== --}}
        <div style="padding: 28px 40px 0 40px;">
            <div style="font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #64748b; margin-bottom: 12px;">Fee Breakdown</div>

            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                {{-- Table Header --}}
                <thead>
                    <tr style="background-color: #1a3c6e;">
                        <th style="padding: 11px 14px; text-align: left; font-size: 11px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; border-radius: 6px 0 0 0;">#</th>
                        <th style="padding: 11px 14px; text-align: left; font-size: 11px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px;">Description</th>
                        <th style="padding: 11px 14px; text-align: center; font-size: 11px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px;"></th>
                        <th style="padding: 11px 14px; text-align: right; font-size: 11px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px;">Unit Price</th>
                        <th style="padding: 11px 14px; text-align: right; font-size: 11px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px; border-radius: 0 6px 0 0;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color: {{ '#f8fafc' }};">
                        <td style="padding: 11px 14px; font-size: 12px; color: #64748b; border-bottom: 1px solid #e2e8f0;">1</td>
                        <td style="padding: 11px 14px; font-size: 13px; color: #1a202c; font-weight: 500; border-bottom: 1px solid #e2e8f0;">{{$info->payment_for}}</td>
                        <td style="padding: 11px 14px; font-size: 13px; color: #1a202c; text-align: center; border-bottom: 1px solid #e2e8f0;"></td>
                        <td style="padding: 11px 14px; font-size: 13px; color: #1a202c; text-align: right; border-bottom: 1px solid #e2e8f0;">&#x20A6;{{ $info->amount }}</td>
                        <td style="padding: 11px 14px; font-size: 13px; color: #1a202c; font-weight: 600; text-align: right; border-bottom: 1px solid #e2e8f0;">&#x20A6;{{ $info->amount }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Totals Block --}}
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 0;">
                <tr>
                    <td style="width: 55%;"></td>
                    <td style="width: 45%;">
                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td style="padding: 9px 14px; font-size: 13px; color: #64748b; border-bottom: 1px solid #e2e8f0;">Subtotal</td>
                                <td style="padding: 9px 14px; font-size: 13px; color: #1a202c; text-align: right; border-bottom: 1px solid #e2e8f0;">&#x20A6;{{ $info->amount }}</td>
                            </tr>
                            <tr style="background-color: #1a3c6e;">
                                <td style="padding: 12px 14px; font-size: 14px; font-weight: 700; color: #ffffff; border-radius: 0 0 0 6px;">Total Paid</td>
                                <td style="padding: 12px 14px; font-size: 16px; font-weight: 900; color: #f59e0b; text-align: right; border-radius: 0 0 6px 0;">&#x20A6;{{ $info->amount }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        {{-- ===== AMOUNT IN WORDS ===== --}}
        <div style="padding: 16px 40px 0 40px;">
            <div style="background-color: #fefce8; border: 1px dashed #f59e0b; border-radius: 8px; padding: 12px 16px;">
                <span style="font-size: 11px; color: #92400e; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Amount in Words: </span>
                <span style="font-size: 12px; color: #78350f; font-style: italic;">{{ $amount_in_words ?? 'One Hundred and Fourteen Thousand' }} Naira Only</span>
            </div>
        </div>

        {{-- ===== NOTES & SIGNATURE ROW ===== --}}
        <div style="padding: 24px 40px 0 40px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="vertical-align: top; width: 55%;">
                        <div style="font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">Notes</div>
                        <div style="font-size: 12px; color: #475569; line-height: 1.7;">
                            {{ $notes ?? 'This receipt serves as official proof of payment. Please keep it safe for future reference. For enquiries, contact the school bursar\'s office.' }}
                        </div>
                    </td>
                    <td style="width: 30px;"></td>
                    <td style="vertical-align: top; text-align: center; width: 40%;">
                        <div style="font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: #64748b; margin-bottom: 8px;">Authorized Signature</div>
                        <div style="border-bottom: 2px solid #1a3c6e; margin-bottom: 6px; height: 40px;"></div>
                        <div style="font-size: 12px; font-weight: 700; color: #1a3c6e;">{{ $bursar_name ?? 'Mrs. Aderonke' }}</div>
                        <div style="font-size: 11px; color: #64748b;">School Bursar</div>
                    </td>
                </tr>
            </table>
        </div>

        {{-- ===== FOOTER ===== --}}
        <div style="margin: 28px 40px 0 40px; border-top: 2px solid #e2e8f0;"></div>

        <div style="padding: 16px 40px 28px 40px;">
            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td style="vertical-align: middle;">
                        {{-- Watermark badge --}}
                        <div style="display: inline-block; border: 2px solid #16a34a; border-radius: 4px; padding: 3px 10px;">
                            <span style="font-size: 11px; font-weight: 800; color: #16a34a; letter-spacing: 1px; text-transform: uppercase;">PAID</span>
                        </div>
                        <span style="font-size: 10px; color: #94a3b8; margin-left: 10px;">Powered by {{ $school_name ?? 'OliveCrib International' }}</span>
                    </td>
                    <td style="text-align: right; vertical-align: middle;">
                        <div style="font-size: 9px; color: #94a3b8;">Generated on {{ now()->format('d M Y, h:i A') }}</div>
                        <div style="font-size: 9px; color: #94a3b8; margin-top: 2px;">This is a computer-generated receipt. No signature required if digitally verified.</div>
                    </td>
                </tr>
            </table>
        </div>

        {{-- Bottom gold accent --}}
        <!-- <div style="height: 5px; background: linear-gradient(90deg, #f59e0b, #fbbf24, #f59e0b);"></div> -->

    </div>

</body>
</html>