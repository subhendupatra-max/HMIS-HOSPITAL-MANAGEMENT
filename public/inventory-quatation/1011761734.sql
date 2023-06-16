 $opd_details =  OpdDetails::where(function ($query) {
            if (!auth()->user()->can('False Generation')) {
                $query->where('ins_by', 'ori');
            }
        })->count();