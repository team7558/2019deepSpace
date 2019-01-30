/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.subsystems;

import edu.wpi.first.wpilibj.command.PIDSubsystem;
import com.revrobotics.CANEncoder;
import com.revrobotics.CANSparkMax;
import com.revrobotics.CANSparkMaxLowLevel.MotorType;
import frc.robot.RobotMap;

/**
 * Add your docs here.
 */
public class Elbow extends PIDSubsystem {
  public static final double ENCODER_TO_ANGLE = 10;

  public static double currentAngle;

  public CANSparkMax elbowController; 
  public CANEncoder elbowEncoder;
  /**
   * Add your docs here.
   */
  public Elbow() {
    // Intert a subsystem name and PID values here
    super("Elbow", 1, 2, 3);
    // Use these to get going:
    setSetpoint(0);
    // to
    enable();

    elbowController = new CANSparkMax(RobotMap.ELBOW_MOTOR, MotorType.kBrushless);
    elbowEncoder = new CANEncoder(elbowController);

  }

  @Override
  public void initDefaultCommand() {
    // Set the default command for a subsystem here.
    // setDefaultCommand(new MySpecialCommand());
  }

  @Override
  protected double returnPIDInput() {
    // Return your input value for the PID loop
    // e.g. a sensor, like a potentiometer:
    // yourPot.getAverageVoltage() / kYourMaxVoltage;
    currentAngle = ENCODER_TO_ANGLE*elbowEncoder.getPosition();
    return currentAngle;
  }

  @Override
  protected void usePIDOutput(double output) {
    // Use output to drive your system, like a motor
    // e.g. yourMotor.set(output);
    elbowController.set(output);
  }

  protected void setAngle(double targetAngle){
    setSetpoint(targetAngle);
  }

}
