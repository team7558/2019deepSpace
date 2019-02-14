/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;

public class ShootCargoBack extends Command {
  public ShootCargoBack() {
    // Use requires() here to declare subsystem dependencies
    super();
    requires(Robot.m_arm);
    requires(Robot.m_claw);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    Robot.m_arm.goToPreset("SHOOT_CARGO_BACK");
    //System.out.println("shooting");
    if (Robot.m_arm.reachedDestination()){
      Robot.m_claw.shootCargo(0.75);
    }
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    return Robot.m_arm.reachedDestination() && !Robot.m_oi.m_operator.getRawButton(Robot.m_oi.shootCargoBackButton);
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
    Robot.m_claw.stopShootCargo();
  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {
  }
}
