<?php

namespace App\Http\Controllers;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Carbon\Carbon;


class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('receipt');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('pdfTemp');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'min:11'],
            'description' => ['required'],
            'amount' => ['required'],
            'mode' => ['required'],
        ]);

        do {
            $receiptNo = 'OLC' . strtoupper(Str::random(6)) . rand(100,99999);
        } while (Receipt::where('transactionid', $receiptNo)->exists());


        $data = new Receipt;
        $data->name = $request->name;
        $data->payment_for = $request->description;
        $data->payment = $request->mode;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->amount = $request->amount;
        $data->transactionid = $receiptNo;

        $data->save();

        // $pdf = Pdf::loadView('pdfTemp', compact('data'));

        // return $pdf->download('itsolution.pdf');

        // return back()->with([
        //     'message' => 'Generated Successfully!',
        //     'pdf_url' => route('erep.download'),
        // ]);

        return response()->json([
            'success' => true,
            'message' => 'Generated Successfully!',
            'download_url' => route('erep.download', $receiptNo),
        ]);
    }

    public function create_pdf($id){

        $info = Receipt::where('transactionid', $id)->first();

        $amount = (int)$info->amount;

        $amount_in_words = $this->numberToWord($amount);

        $pdf = Pdf::loadView('pdfTemp', compact('info', 'amount_in_words'));

        return $pdf->download($info->name.'~'.$info->transactionid.'.pdf');
    }

    public function numberToWord($num = '')

    {

        $num    = ( string ) ( ( int ) $num );

        

        if( ( int ) ( $num ) && ctype_digit( $num ) )

        {

            $words  = array( );

             

            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

             

            $list1  = array('','one','two','three','four','five','six','seven',

                'eight','nine','ten','eleven','twelve','thirteen','fourteen',

                'fifteen','sixteen','seventeen','eighteen','nineteen');

             

            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',

                'seventy','eighty','ninety','hundred');

             

            $list3  = array('','thousand','million','billion','trillion',

                'quadrillion','quintillion','sextillion','septillion',

                'octillion','nonillion','decillion','undecillion',

                'duodecillion','tredecillion','quattuordecillion',

                'quindecillion','sexdecillion','septendecillion',

                'octodecillion','novemdecillion','vigintillion');

             

            $num_length = strlen( $num );

            $levels = ( int ) ( ( $num_length + 2 ) / 3 );

            $max_length = $levels * 3;

            $num    = substr( '00'.$num , -$max_length );

            $num_levels = str_split( $num , 3 );

             

            foreach( $num_levels as $num_part )

            {

                $levels--;

                $hundreds   = ( int ) ( $num_part / 100 );

                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '' );

                $tens       = ( int ) ( $num_part % 100 );

                $singles    = '';

                 

                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )

            {

                $commas = $commas - 1;

            }

             

            $words  = implode( ', ' , $words );

             

            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );

            if( $commas )

            {

                $words  = str_replace( ',' , ' and' , $words );

            }

             

            return $words;

        }

        else if( ! ( ( int ) $num ) )

        {

            return 'Zero';

        }

        return '';

    }

    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
