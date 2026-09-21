<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;

enum Status: string implements HasColor, HasDescription, HasIcon, HasLabel
{
    // Machine related status
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Removed = 'Removed';

    // Activity status
    case InProgress = 'In progress';
    case NeedInfo = 'Need info';
    case Complete = 'Complete';
    
    // Survey related status
    case Current = 'Current';
    case Due30d = 'Due within 30 days';
    case Overdue13m = 'Overdue < 13 months';
    case Overdue = 'Overdue > 13 months';
    case Scheduled = 'Scheduled, not tested yet';

    public function getColor(): ?string
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'warning',
            self::Removed => 'danger',
            self::InProgress => 'info',
            self::NeedInfo => 'warning',
            self::Complete => 'success',
            self::Current => 'success',
            self::Due30d => Color::Yellow,
            self::Overdue13m => Color::Orange,
            self::Overdue => 'danger',
            self::Scheduled => 'info',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Active => 'In use',
            self::Inactive => 'Not in use, but has not been removed yet',
            self::Removed => 'No longer in use and has been removed',
            self::InProgress => 'In progress',
            self::NeedInfo => 'Awaiting additional information',
            self::Complete => 'Complete',
            self::Current => 'Current',
            self::Due30d => 'Due within 30 days',
            self::Overdue13m => 'Overdue < 13 months',
            self::Overdue => 'Overdue > 13 months',
            self::Scheduled => 'Scheduled, not tested yet',
        };
    }

    public function getIcon(): string|BackedEnum
    {
        return match ($this) {
            self::Active => Heroicon::Check,
            self::Inactive => Heroicon::XCircle,
            self::Removed => Heroicon::Trash,
            self::InProgress => Heroicon::Document,
            self::NeedInfo => Heroicon::InformationCircle,
            self::Complete => Heroicon::DocumentCheck,
            self::Current => Heroicon::DocumentCheck,
            self::Due30d => Heroicon::BellAlert,
            self::Overdue13m => Heroicon::ExclamationCircle,
            self::Overdue => Heroicon::ExclamationTriangle,
            self::Scheduled => Heroicon::CalendarDays,
        };
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
